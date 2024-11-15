<?php

namespace Database\Factories;

use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Country>
 */
class CountryFactory extends Factory
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

    public static function buildFromNextEvent(\stdClass $event): Country
    {
        $countryModel = new Country;
        $countryModel->name = $event->tournament->category->name;
        $countryModel->code = $event->tournament->category->alpha2;
        $countryModel->import_id = $event->tournament->category->id;

        return $countryModel;
    }
}
