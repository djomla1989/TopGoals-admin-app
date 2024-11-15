<?php

namespace App\Console\Commands\SportsImport;

use App\Enums\Gender;
use App\Models\Country;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teams {--overwrite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all teams data from MongoDB collection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodb');
        $teams = $conn->table('teams')->where('id', '>', 528530)->orderBy('id')->get();

        $sport = Sport::where('name', 'Football')->first();
        $sportId = $sport->id;

        $countryList = [];
        $primaryUniqueTournamentList = [];
        $primaryUniqueTournamentList[null] = null;

        foreach ($teams as $team) {
            $team = json_decode(json_encode($team));

            $this->info("Importing team: {$team->name} - {$team->id}");
            $existingTeam = Team::where('import_id', $team->id)->first();

            if ($existingTeam && ! $this->option('overwrite')) {
                continue;
                $this->info("Team {$team->name} already exists. Use --overwrite to update.");
            }

            if (empty($team->tournament)) {
                $this->error("Team tournament not found for team: {$team->name} - {$team->id}");

                continue;
            }

            if (! isset($countryList[$team->tournament->category->id])) {
                $countryModel = Country::where('import_id', $team->tournament->category->id)->first();

                if (empty($countryModel)) {
                    $countryModel = new Country;
                    $countryModel->name = $team->tournament->category->name;
                    $countryModel->code = $team->tournament->category?->alpha2 ?? '';
                    $countryModel->import_id = $team->tournament->category->id;
                    $countryModel->save();
                    $this->comment("Country {$team->tournament->category->name} created.");
                }
                $countryList[$team->tournament->category->id] = $countryModel->id;
            }

            if (! isset($primaryUniqueTournamentList[$team->tournament->uniqueTournament->id])) {
                $tournamentModel = Tournament::where('import_id', $team->tournament->uniqueTournament->id)->first();

                if (empty($tournamentModel)) {
                    $tournamentModel = new Tournament;
                    $tournamentModel->name = $team->tournament->uniqueTournament->name;
                    $tournamentModel->slug = $team->tournament->uniqueTournament->slug;
                    $tournamentModel->import_id = $team->tournament->uniqueTournament->id;
                    $tournamentModel->sport_id = $sportId;
                    $tournamentModel->country_id = $countryList[$team->tournament->category->id];
                    $tournamentModel->gender = Gender::resolveGender($team?->gender ?? '', $team->name);
                    $tournamentModel->save();
                    $this->comment("Tournament {$team->tournament->uniqueTournament->name} created.");
                }
                $primaryUniqueTournamentList[$team->tournament->uniqueTournament->id] = $tournamentModel->id;
            }

            $teamModel = $existingTeam ?? new Team;

            $teamModel->name = $team->name;
            $teamModel->short_name = $team->shortName ?? '';
            $teamModel->code = $team->nameCode ?? '';
            $teamModel->import_id = $team->id;
            $teamModel->is_national = $team->national ?? false;
            $teamModel->image = $team->image ?? '';
            $teamModel->slug = $team->slug ?? '';
            $teamModel->sport_id = $sportId;
            $teamModel->primary_color = $team->teamColors->primary ?? '';
            $teamModel->gender = Gender::resolveGender($team?->gender ?? '', $team->name);
            $teamModel->country_id = $countryList[$team->tournament->category->id];
            $teamModel->primary_tournament_id = $primaryUniqueTournamentList[$team->tournament->uniqueTournament->id];

            $teamModel->save();

            $this->info('Imported/Updated team: '.$teamModel->name);

        }

        $this->info('All teams imported/updated successfully.');
    }
}
