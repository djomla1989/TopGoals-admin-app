<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }

    public static function buildFromCategory(\stdClass $category, ?Category $existingCategory = null): Category
    {
        if ($existingCategory) {
            $categoryModel = $existingCategory;
        } else {
            $categoryModel = new Category();
        }

        $categoryModel->name = $category->name;
        $categoryModel->slug = $category->slug;
        $categoryModel->code = $category->alpha2 ?? '';
        $categoryModel->import_id = $category->id;

        return $categoryModel;
    }

    public static function buildFromNextEvent(\stdClass $event): Category
    {
        return CategoryFactory::buildFromCategory($event->tournament->category);
    }
}
