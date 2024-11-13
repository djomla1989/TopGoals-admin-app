<?php

namespace App\Console\Commands\SportsImport;

use App\Models\Country;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCountries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:countries {--overwrite}';

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
        $contriesList = $conn->table('categories')->orderBy('name')->get();
        foreach ($contriesList as $country) {
            $this->info("Importing country: {$country->name}");
            $existingCountry = Country::where('name', $country->name)->first();

            if ($existingCountry && !$this->option('overwrite')) {
                $this->info("Country {$country->name} already exists. Use --overwrite to update.");
                continue;
            }

            $countryModel = $existingCountry ?? new Country();

            $countryModel->name = $country->name;
            $countryModel->image = $country->image ?? '';
            $countryModel->import_id = $country->id;
            $countryModel->description = $country->description ?? '';
            $countryModel->code = $country->alpha2 ?? '';

            $countryModel->save();

            $this->info("Imported/Updated country: " . $country->name);

        }

        $this->info('All countries imported/updated successfully.');
    }
}
