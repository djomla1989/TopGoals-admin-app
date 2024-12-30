<?php

namespace App\Console\Commands\SportsImport\Tipster;

use App\Models\Tipster\CategoryTipster;
use App\Models\Tipster\TournamentTipster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournamentsTipster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tipsterOddsFeed:import-tournaments-tipster {--overwrite} {--v}';

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
        $tournamentList = $conn->table('tournaments')->orderBy('name')->get();

        foreach ($tournamentList as $tournament) {
            $tournament = json_decode(json_encode($tournament));

            $this->info("Importing tournament: {$tournament?->name} - {$tournament->id}");
            $existingTournament = TournamentTipster::where('import_id', $tournament->id)->first();

            if ($existingTournament && ! $this->option('overwrite')) {
                $this->info("Tournament {$tournament->name} already exists. Use --overwrite to update.");

                continue;
            }

            $category = CategoryTipster::where('import_id', $tournament->category->id)->first();
            if (! $category) {
                $this->error("Category {$tournament->category->name} not found for tournament {$tournament->name}.");

                continue;
            }

            $tournamentModel = $existingTournament ?? new TournamentTipster;

            $tournamentModel->name = $tournament->name;
            $tournamentModel->import_id = $tournament->id;
            $tournamentModel->slug = $tournament->slug;
            $tournamentModel->category_id = $category->id;

            $tournamentModel->save();

            $this->info('Imported/Updated tournament: '.$tournament->name);
        }

        $this->info('All tournaments imported/updated successfully.');
    }
}
