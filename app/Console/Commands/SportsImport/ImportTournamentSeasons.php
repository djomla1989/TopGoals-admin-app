<?php

namespace App\Console\Commands\SportsImport;

use App\Models\AllSports\SportAllSports;
use App\Models\AllSports\TournamentAllSports;
use Database\Factories\TournamentSeasonFactory;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournamentSeasons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tournament-seasons {--overwrite} {--test} {--v}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all tournament seasons data from MongoDB collection';

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

        $missingCount = 0;

        $conn = DB::connection('mongodb');
        $tournamentSeasonList = $conn->table('uniqueTournamentSeasons')->orderBy('name')->get();

        $sport = SportAllSports::where('name', 'Football')->first();
        if (! $sport) {
            $this->info('Sport "Football" not found. Please import sports first.');

            return;
        }

        foreach ($tournamentSeasonList as $tournamentSeason) {
            $tournamentSeason = json_decode(json_encode($tournamentSeason));

            if ($this->option('v')) {
                $this->info("Importing tournament seasons: {$tournamentSeason->name} - {$tournamentSeason->id}");
            }

            $existingTournamentSeason = TournamentAllSports::where('import_id', $tournamentSeason->id)->first();

            if ($existingTournamentSeason && ! $this->option('overwrite')) {
                if ($this->option('v')) {
                    $this->info("Tournament season {$tournamentSeason->name} already exists. Use --overwrite to update.");
                }

                continue;
            }

            $tournament = TournamentAllSports::where('import_id', $tournamentSeason->uniqueTournament->id)->first();

            if (! $tournament) {
                $this->error("Season {$tournamentSeason->name} does not have a tournament {$tournamentSeason->uniqueTournament->id} in database. Skipping.");

                continue;
            }

            $tournamentSeasonModel = TournamentSeasonFactory::buildFromSeason(
                $tournamentSeason,
                $tournament->id,
                $existingTournamentSeason
            );

            if ($liveMode) {
                $tournamentSeasonModel->save();
                $this->info('Imported/Updated tournament season: '.$tournamentSeason->name);
            }
        }

        $this->info('Total missing seasons: '.$missingCount);
        $this->info('All tournament seasons imported/updated successfully.');
    }
}
