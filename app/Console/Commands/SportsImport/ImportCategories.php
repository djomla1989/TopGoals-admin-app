<?php

namespace App\Console\Commands\SportsImport;

use App\Models\AllSports\CategoryAllSports;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCategories extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:categories {--overwrite}';

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
        foreach ($contriesList as $category) {
            $category = json_decode(json_encode($category));

            $this->info("Importing country: {$category->name}");
            $existingCategory = CategoryAllSports::where('name', $category->name)->first();

            if ($existingCategory && ! $this->option('overwrite')) {
                $this->info("Category {$category->name} already exists. Use --overwrite to update.");

                continue;
            }

            $categoryModel = $existingCategory ?? new CategoryAllSports;

            $categoryModel->name = $category->name;
            $categoryModel->import_id = $category->id;
            $categoryModel->code = $category->alpha2 ?? '';
            $categoryModel->slug = $category->slug;
            $categoryModel->priority = $category->priority;

            $categoryModel->save();

            $this->info('Imported/Updated category: '.$category->name);

        }

        $this->info('All category imported/updated successfully.');
    }
}
