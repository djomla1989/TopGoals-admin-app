<?php

namespace App\Console\Commands\SportsImport;

use App\Gender;
use App\Models\Country;
use App\Models\Sport;
use App\Models\Tournament;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournaments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tournaments {--overwrite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all tournaments data from MongoDB collection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodb');
        $tournamentList = $conn->table('uniqueTournaments')->orderBy('name')->get();

        $sport = Sport::where('name', 'Football')->first();
        if (!$sport) {
            $this->info('Sport "Football" not found. Please import sports first.');
            return;
        }

        foreach ($tournamentList as $tournament) {
            $tournament = (object)$tournament;

            $this->info("Importing country: {$tournament->name} - {$tournament->id}");
            $existingTournament = Tournament::where('name', $tournament->name)->first();


            if ($existingTournament && !$this->option('overwrite')) {
                $this->info("Country {$tournament->name} already exists. Use --overwrite to update.");
                continue;
            }

            if (empty($tournament->category['id'])) {
                $this->info("Country {$tournament->name} does not have a country_id. Skipping.");
                continue;
            }

            $country = Country::where('import_id', $tournament->category['id'])->first();

            if (!$country) {
                $this->info("Country {$tournament->name} does not have a country_id. Skipping.");
                continue;
            }

            $tournamentMeta = $conn->table('uniqueTournamentMeta')
                ->where('uniqueTournament.id', $tournament->id)->first();

            if (!$tournamentMeta) {
                $this->error('Tournament meta not found for: ' . $tournament->name. ' - ' . $tournament->id);
            } else {
                $this->question('Tournament meta found for: ' . $tournament->name. ' - ' . $tournament->id);
            }

            $tournamentModel = $existingTournament ?? new Tournament();

            $gender = Gender::resolveGender($tournamentMeta?->gender ?? 'missing', $tournament->name);

            $tournamentModel->name = $tournament->name;
            $tournamentModel->image = $tournament->image ?? '';
            $tournamentModel->import_id = $tournament->id;
            $tournamentModel->description = $tournament->description ?? '';
            $tournamentModel->slug = $tournament->slug ?? '';
            $tournamentModel->sport_id = $sport->id;
            $tournamentModel->country_id = $country->id;
            $tournamentModel->gender = $gender->value;

            $tournamentModel->save();

            $this->info("Imported/Updated tournament: " . $tournament->name);

        }

        $this->info('All tournaments imported/updated successfully.');
    }
}
