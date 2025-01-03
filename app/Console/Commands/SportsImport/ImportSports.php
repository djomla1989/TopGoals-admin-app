<?php

namespace App\Console\Commands\SportsImport;

use App\Models\AllSports\SportAllSports;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportSports extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:sports {--overwrite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all sports data from MongoDB collection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodb');
        $sportList = $conn->table('sports')->orderBy('id')->get();

        foreach ($sportList as $sport) {
            $sport = json_decode(json_encode($sport));

            $this->info("Importing sport: {$sport->name}");

            $existingSport = SportAllSports::where('name', $sport->name)->first();

            if ($existingSport && ! $this->option('overwrite')) {
                $this->info("Sport {$sport->name} already exists. Use --overwrite to update.");

                continue;
            }

            $sportModel = $existingSport ?? new SportAllSports;

            $sportModel->name = $sport->name;
            $sportModel->import_id = $sport->id;
            $sportModel->slug = $sport->slug ?? '';

            $sportModel->save();

            $this->info('Imported/Updated category: '.$sport->name);

        }

        $this->info('All sports imported/updated successfully.');
    }
}
