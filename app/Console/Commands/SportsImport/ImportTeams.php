<?php

namespace App\Console\Commands\SportsImport;

use App\Enums\Gender;
use App\Models\Category;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Tournament;
use Database\Factories\CategoryFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TournamentFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTeams extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:teams {--overwrite} {--test} {--v}';

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
        $liveMode = true;
        if ($this->option('test')) {
            $this->error('Test mode. Skipping save.');
            $liveMode = false;
        }

        $conn = DB::connection('mongodb');
        $teams = $conn->table('teamDetails')->orderBy('id')->get();

        $sport = Sport::where('name', 'Football')->first();
        $sportId = $sport->id;

        $categoryList = [];
        $primaryUniqueTournamentList = [];
        $primaryUniqueTournamentList[null] = null;

        foreach ($teams as $team) {
            $team = json_decode(json_encode($team));

            if ($this->option('v')) {
                $this->info("Importing team: {$team->name} - {$team->id}");
            }

            $existingTeam = Team::where('import_id', $team->id)->first();

            if ($existingTeam && ! $this->option('overwrite')) {
                $this->error("Team {$team->name} already exists. Use --overwrite to update.");
                continue;
            }

            if (empty($team->tournament) && empty($team->primaryUniqueTournament)) {
                $this->error("Team tournament and primaryUniqueTournament not found for team: {$team->name} - {$team->id}");
                continue;
            }

            if (!empty($team->tournament)) {
                $teamTournament = $team->tournament;
            } else {
                $teamTournament = $team->primaryUniqueTournament;
            }

            if (! isset($categoryList[$teamTournament->category->id])) {
                $categoryModel = Category::where('import_id', $teamTournament->category->id)->first();

                if (empty($categoryModel)) {
                    $categoryModel = CategoryFactory::buildFromCategory($teamTournament->category);
                    if ($liveMode) {
                        $categoryModel->save();
                    } else {
                        $categoryModel->id = rand(1, 99999);
                    }
                    $this->comment("Category `{$categoryModel->name}` {$categoryModel->id} for team {$team->id} created.");

                }
                $categoryList[$teamTournament->category->id] = $categoryModel->id;
            }

            $tournamentId = $teamTournament->uniqueTournament->id ?? null;
            if (!empty($tournamentId) && ! isset($primaryUniqueTournamentList[$tournamentId])) {
                $tournamentModel = Tournament::where('import_id', $teamTournament->uniqueTournament->id)->first();

                if (empty($tournamentModel)) {
                    $tournamentModel = TournamentFactory::buildFromTeam($team, $sportId, $categoryList[$teamTournament->category->id]);
                    if ($liveMode) {
                        $tournamentModel->save();
                    } else {
                        $tournamentModel->id = rand(1, 99999);
                    }
                    $this->comment("Tournament `{$tournamentModel->name}` {$tournamentModel->id} for team {$team->id}  created.");

                }
                $primaryUniqueTournamentList[$teamTournament->uniqueTournament->id] = $tournamentModel->id;
            }

            $teamModel = TeamFactory::buildFromTeam(
                $team,
                $sportId,
                $categoryList[$teamTournament->category->id],
                $primaryUniqueTournamentList[$tournamentId],
                $existingTeam
            );

            if ($liveMode) {
                $teamModel->save();

                $this->info('Imported/Updated team: `' . $teamModel->name. '` - import id:' . $teamModel->import_id);
            }

        }

        $this->info('All teams imported/updated successfully.');
    }
}
