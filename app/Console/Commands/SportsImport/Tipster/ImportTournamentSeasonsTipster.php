<?php

namespace App\Console\Commands\SportsImport\Tipster;

use App\Models\Tipster\TournamentSeasonsTipster;
use App\Models\Tipster\TournamentTipster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournamentSeasonsTipster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tipsterOddsFeed:import-tournament-seasons-tipster {--overwrite} {--v}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodbTipsterOddsFeed');
        $seasonList = $conn->table('seasons')->orderBy('name')->get();

        foreach ($seasonList as $season) {
            $season = json_decode(json_encode($season));

            $this->info("Importing season: {$season?->slug} - {$season->id}");
            $existingSeason = TournamentSeasonsTipster::where('import_id', $season->id)->first();

            if ($existingSeason && ! $this->option('overwrite')) {
                $this->info("Season {$season->name} already exists. Use --overwrite to update.");

                continue;
            }

            $tournament = TournamentTipster::where('import_id', $season->tournament->id)->first();
            if (! $tournament) {
                $this->error("Tournament {$season->tournament->name} not found for tournament {$season->slug}.");

                continue;
            }

            $seasonModel = $existingSeason ?? new TournamentSeasonsTipster;

            $seasonModel->name = $season->slug;
            $seasonModel->import_id = $season->id;
            $seasonModel->slug = $season->slug;
            $seasonModel->tournament_id = $tournament->id;
            $seasonModel->year = $season->slug;

            $seasonModel->save();

            $this->info('Imported/Updated season: '.$seasonModel->name);
        }

        $this->info('All tournaments imported/updated successfully.');
    }
}
