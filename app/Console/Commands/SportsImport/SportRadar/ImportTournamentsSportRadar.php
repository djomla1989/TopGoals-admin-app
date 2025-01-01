<?php

namespace App\Console\Commands\SportsImport\SportRadar;

use App\Models\SportRadar\CategorySportRadar;
use App\Models\SportRadar\TournamentSportRadar;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportTournamentsSportRadar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportRadar:import-tournaments {sport?} {--overwrite} {--v}';

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
        $sport = $this->argument('sport') ?? 'soccer';

        $conn = DB::connection('mysqlSportRadar');
        $tournamentList = $conn->table('tournaments')->where('sport_id', $sport)->orderBy('name')->get();

        foreach ($tournamentList as $tournament) {

            $tournament->name = json_decode($tournament->name)->en;

            $this->info("Importing tournament: {$tournament?->name} - {$tournament->sportradar_id}");
            $existingTournament = TournamentSportRadar::where('import_id', $tournament->sportradar_id)->first();

            if ($existingTournament && ! $this->option('overwrite')) {
                $this->info("Tournament {$tournament->name} already exists. Use --overwrite to update.");

                continue;
            }

            $sportRadarCategory = $conn->table('categories')->where('id', $tournament->category_id)->first();

            $category = CategorySportRadar::where('import_id', $sportRadarCategory?->sportradar_id)->first();
            if (! $category) {
                $this->error("Category {$tournament->category_id} not found for tournament {$tournament->name} {$tournament->sportradar_id}.");

                continue;
            }

            $tournamentModel = $existingTournament ?? new TournamentSportRadar();

            $tournamentModel->name = $tournament->name;
            $tournamentModel->import_id = $tournament->sportradar_id;
            $tournamentModel->slug = Str::slug($tournament->name);
            $tournamentModel->category_id = $category->id;

            $tournamentModel->save();

            $this->info('Imported/Updated tournament: '.$tournament->name);
        }

        $this->info('All tournaments imported/updated successfully.');
    }
}
