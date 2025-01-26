<?php

namespace App\Console\Commands\MVPDataImport;

use App\Models\Category;
use App\Models\Sport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CategoryImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:category-import';

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
        $conn = DB::connection('mongodbOsSport');
        $categoryList = $conn->table('categories')->orderBy('name')->get();

        foreach ($categoryList as $category) {
            $category = json_decode(json_encode($category));


            $this->info("Importing category: {$category->name} - {$category->id}");
            $existingCategory = Category::where('source_id', $category->id)->first();

            $sport = Sport::where('source_id', $category->sport->id)->first();

            if (empty($sport)) {
                $this->error("Sport {$category->sport->id} not found for category {$category->name}.");
                continue;
            }

            if ($existingCategory && ! $this->option('overwrite')) {
                $this->info("Category {$category->name} already exists. Use --overwrite to update.");

                continue;
            }

            $categoryModel = $existingCategory ?? new Category();

            $categoryModel->name = $category->name;
            $categoryModel->source_id = $category->syncImportId;
            $categoryModel->country_code = $category->alpha2 ?? '';
            $categoryModel->slug = $category->slug;
            $categoryModel->is_active = false;
            $categoryModel->sport_id = $sport->id;

            $categoryModel->save();

            $this->info('Imported/Updated category: '.$category->name);

        }

        $this->info('All category imported/updated successfully.');
    }
}
