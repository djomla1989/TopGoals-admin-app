<?php

namespace App\Console\Commands\SportsImport\SportRadar;

use App\Models\OsSport\SportOsSport;
use App\Models\SportRadar\SportSportRadar;
use App\Models\Tipster\SportTipster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSportsSportRadar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportRadar:import-sports {--overwrite} {--v}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import sports from OsSport source';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mysqlSportRadar');
        $sportList = $conn->table('sports')->orderBy('id')->get();

        foreach ($sportList as $sport) {

            $sport->name = json_decode($sport->name)->en;
            $this->info("Importing sport: {$sport->name} - {$sport->sportradar_id}");

            $existingSport = SportSportRadar::where('import_id', $sport->sportradar_id)->first();

            if ($existingSport && ! $this->option('overwrite')) {
                $this->info("Sport {$sport->name} already exists. Use --overwrite to update.");

                continue;
            }

            $sportModel = $existingSport ?? new SportSportRadar();

            $sportModel->name = $sport->name;
            $sportModel->import_id = $sport->sportradar_id;
            $sportModel->slug = $sport->slug ?? '';

            $sportModel->save();

            $this->info('Imported/Updated category: '.$sport->name);

        }

        $this->info('All sports imported/updated successfully.');
    }
}
