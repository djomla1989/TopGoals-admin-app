<?php

namespace App\Console\Commands\SportsImport\OsSport;

use App\Models\OsSport\CategoryOsSport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCategoriesOsSport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'osSport:import-categories {--overwrite} {--v}';

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
        $conn = DB::connection('mongodbOsSport');
        $categoryList = $conn->table('categories')->orderBy('name')->get();

        foreach ($categoryList as $category) {
            $category = json_decode(json_encode($category));

            $this->info("Importing category: {$category->name} - {$category->id}");
            $existingCategory = CategoryOsSport::where('import_id', $category->id)->first();

            if ($existingCategory && ! $this->option('overwrite')) {
                $this->info("Category {$category->name} already exists. Use --overwrite to update.");

                continue;
            }

            $categoryModel = $existingCategory ?? new CategoryOsSport();

            $categoryModel->name = $category->name;
            $categoryModel->import_id = $category->id;
            $categoryModel->code = $category->alpha2 ?? '';
            $categoryModel->slug = $category->slug;

            $categoryModel->save();

            $this->info('Imported/Updated category: '.$category->name);

        }

        $this->info('All category imported/updated successfully.');
    }
}
