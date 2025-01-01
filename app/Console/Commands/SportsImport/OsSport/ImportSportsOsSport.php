<?php

namespace App\Console\Commands\SportsImport\OsSport;

use App\Models\OsSport\SportOsSport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSportsOsSport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'osSport:import-sports {--overwrite} {--v}';

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
        $conn = DB::connection('mongodbOsSport');
        $sportList = $conn->table('sports')->orderBy('id')->get();

        foreach ($sportList as $sport) {
            $sport = json_decode(json_encode($sport));

            $this->info("Importing sport: {$sport->name} - {$sport->id}");

            $existingSport = SportOsSport::where('import_id', $sport->id)->first();

            if ($existingSport && ! $this->option('overwrite')) {
                $this->info("Sport {$sport->name} already exists. Use --overwrite to update.");

                continue;
            }

            $sportModel = $existingSport ?? new SportOsSport();

            $sportModel->name = $sport->name;
            $sportModel->import_id = $sport->id;
            $sportModel->slug = $sport->slug ?? '';

            $sportModel->save();

            $this->info('Imported/Updated category: '.$sport->name);

        }

        $this->info('All sports imported/updated successfully.');
    }
}
