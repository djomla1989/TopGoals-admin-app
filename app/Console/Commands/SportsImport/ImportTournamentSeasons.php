<?php

namespace App\Console\Commands\SportsImport;

use App\Models\Sport;
use App\Models\Tournament;
use App\Models\TournamentSeason;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournamentSeasons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tournament-seasons {--overwrite}';

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
        $conn = DB::connection('mongodb');
        $tournamentSeasonList = $conn->table('uniqueTournamentSeasons')->orderBy('name')->get();

        $sport = Sport::where('name', 'Football')->first();
        if (!$sport) {
            $this->info('Sport "Football" not found. Please import sports first.');
            return;
        }

        foreach ($tournamentSeasonList as $tournamentSeason) {
            $tournamentSeason = (object)$tournamentSeason;

            $this->info("Importing tournament seasons: {$tournamentSeason->name} - {$tournamentSeason->id}");
            $existingTournamentSeason = Tournament::where('name', $tournamentSeason->name)->first();


            if ($existingTournamentSeason && !$this->option('overwrite')) {
                $this->info("Country {$tournamentSeason->name} already exists. Use --overwrite to update.");
                continue;
            }

            if (empty($tournamentSeason->uniqueTournament['id'])) {
                $this->info("Season {$tournamentSeason->name} does not have a tournament. Skipping.");
                continue;
            }

            $tournament = Tournament::where('import_id', $tournamentSeason->uniqueTournament['id'])->first();

            if (!$tournament) {
                $this->info("Season {$tournamentSeason->name} does not have a tournament {$tournamentSeason->uniqueTournament['id']} in database. Skipping.");
                continue;
            }


            $tournamentSeasonModel = $existingTournamentSeason ?? new TournamentSeason();


            $tournamentSeasonModel->name = $tournamentSeason->name;
            $tournamentSeasonModel->image = $tournamentSeason->image ?? '';
            $tournamentSeasonModel->import_id = $tournamentSeason->id;
            $tournamentSeasonModel->description = $tournamentSeason->description ?? '';
            $tournamentSeasonModel->slug = $tournamentSeason->slug ?? '';
            $tournamentSeasonModel->tournament_id = $tournament->id;
            $tournamentSeasonModel->year = $tournamentSeason->year;

            $tournamentSeasonModel->save();

            $this->info("Imported/Updated tournament season: " . $tournamentSeason->name);

        }

        $this->info('All tournament seasons imported/updated successfully.');
    }
}
