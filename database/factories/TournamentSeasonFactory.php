<?php

namespace Database\Factories;

use App\Models\TournamentSeason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TournamentSeason>
 */
class TournamentSeasonFactory extends Factory
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

    public static function buildFromNextEvent(\stdClass $event, int $tournamentId): TournamentSeason
    {
        $tournamentSeasonModel = new TournamentSeason;

        $tournamentSeasonModel->name = $event->season->name;
        $tournamentSeasonModel->slug = $event->season->slug ?? '';
        $tournamentSeasonModel->import_id = $event->season->id;
        $tournamentSeasonModel->tournament_id = $tournamentId;
        $tournamentSeasonModel->year = $event->season->year;
        $tournamentSeasonModel->save();

        return $tournamentSeasonModel;
    }
}
