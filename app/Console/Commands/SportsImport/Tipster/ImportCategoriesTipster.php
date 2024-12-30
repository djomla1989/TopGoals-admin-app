<?php

namespace App\Console\Commands\SportsImport\Tipster;

use App\Models\Tipster\CategoryTipster;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportCategoriesTipster extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tipsterOddsFeed:import-categories {--overwrite} {--v}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import categories from tipster source';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodbTipsterOddsFeed');
        $categoryList = $conn->table('categories')->orderBy('name')->get();

        foreach ($categoryList as $category) {
            $category = json_decode(json_encode($category));

            $this->info("Importing category: {$category->name} - {$category->id}");
            $existingCategory = CategoryTipster::where('import_id', $category->id)->first();

            if ($existingCategory && ! $this->option('overwrite')) {
                $this->info("Category {$category->name} already exists. Use --overwrite to update.");

                continue;
            }

            $categoryModel = $existingCategory ?? new CategoryTipster;

            $categoryModel->name = $category->name;
            $categoryModel->import_id = $category->id;
            $categoryModel->code = $category->code ?? '';
            $categoryModel->slug = $category->slug;

            $categoryModel->save();

            $this->info('Imported/Updated category: '.$category->name);

        }

        $this->info('All category imported/updated successfully.');
    }
}
