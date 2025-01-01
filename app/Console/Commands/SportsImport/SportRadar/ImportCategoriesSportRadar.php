<?php

namespace App\Console\Commands\SportsImport\SportRadar;

use App\Models\OsSport\CategoryOsSport;
use App\Models\SportRadar\CategorySportRadar;
use App\Models\Tipster\CategoryTipster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ImportCategoriesSportRadar extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sportRadar:import-categories {sport?} {--overwrite} {--v}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import categories from Os Sport source';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sport = $this->argument('sport') ?? 'soccer';

        $conn = DB::connection('mysqlSportRadar');
        $categoryList = $conn->table('categories')->where('sport_id', $sport)->orderBy('country_code')->get();

        foreach ($categoryList as $category) {

            $category->name = json_decode($category->name)->en;

            $this->info("Importing category: {$category->name} - {$category->sportradar_id}");
            $existingCategory = CategorySportRadar::where('import_id', $category->sportradar_id)->first();

            if ($existingCategory && ! $this->option('overwrite')) {
                $this->info("Category {$category->name} already exists. Use --overwrite to update.");

                continue;
            }

            $categoryModel = $existingCategory ?? new CategorySportRadar();

            $categoryModel->name = $category->name;
            $categoryModel->import_id = $category->sportradar_id;
            $categoryModel->code = $category->country_code ?? '';
            $categoryModel->slug = $category->slug ?? Str::slug($category->name);

            $categoryModel->save();

            $this->info('Imported/Updated category: '.$category->name);

        }

        $this->info('All category imported/updated successfully.');
    }
}
