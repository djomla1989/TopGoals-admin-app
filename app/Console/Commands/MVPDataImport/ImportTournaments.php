<?php

namespace App\Console\Commands\MVPDataImport;

use App\Jobs\Sync\Tournament\SyncTournamentDataJob;
use App\Models\Category;
use App\Models\OsSport\CategoryOsSport;
use App\Models\OsSport\TournamentOsSport;
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
    protected $signature = 'app:import-tournaments {--overwrite} {--v}';

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
        $activeCategories = Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $conn = DB::connection('mongodbOsSport');

        foreach ($activeCategories as $category) {
            $tournamentList = $conn->table('tournaments')
                ->where('category.id', $category->source_id)
                ->orderBy('name')
                ->get();

            foreach ($tournamentList as $tournament) {
                $tournament = json_decode(json_encode($tournament));

                $this->info("Importing tournament: {$tournament?->name} - {$tournament->id}");
                $existingTournament = Tournament::where('source_id', $tournament->id)->first();

                if ($existingTournament && ! $this->option('overwrite')) {
                    $this->info("Tournament {$tournament->name} already exists. Use --overwrite to update.");

                    continue;
                }


                $tournamentModel = $existingTournament ?? new Tournament();

                $tournamentModel->name = $tournament->name;
                $tournamentModel->source_id = $tournament->id;
                $tournamentModel->slug = $tournament->slug;
                $tournamentModel->sport_id = $category->sport_id;
                $tournamentModel->category_id = $category->id;

                $tournamentModel->save();

                SyncTournamentDataJob::dispatch($tournamentModel);

                $this->info('Imported/Updated tournament: '.$tournament->name);
            }
        }


        $this->info('All tournaments imported/updated successfully.');
    }
}
