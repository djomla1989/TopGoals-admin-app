<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tournament>
 */
class TournamentFactory extends Factory
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

    public static function buildFromNextEvent(\stdClass $event, int $sportId, int $countryId): Tournament
    {
        $tournamentModel = new Tournament;

        $tournamentModel->name = $event->tournament->uniqueTournament->name;
        $tournamentModel->slug = $event->tournament->uniqueTournament->slug;
        $tournamentModel->import_id = $event->tournament->uniqueTournament->id;
        $tournamentModel->sport_id = $sportId;
        $tournamentModel->country_id = $countryId;
        $tournamentModel->gender = Gender::resolveGender($event->homeTeam->gender ?? '', $event->slug);
        $tournamentModel->save();

        return $tournamentModel;
    }
}
