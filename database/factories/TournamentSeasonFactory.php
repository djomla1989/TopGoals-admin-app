<?php

namespace Database\Factories;

use App\Models\AllSports\TournamentSeasonAllSports;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AllSports\TournamentSeasonAllSports>
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

    public static function buildFromNextEvent(\stdClass $event, int $tournamentId): TournamentSeasonAllSports
    {
        $tournamentSeasonModel = new TournamentSeasonAllSports;

        $tournamentSeasonModel->name = $event->season->name;
        $tournamentSeasonModel->slug = $event->season->slug ?? '';
        $tournamentSeasonModel->import_id = $event->season->id;
        $tournamentSeasonModel->tournament_id = $tournamentId;
        $tournamentSeasonModel->year = $event->season->year;
        $tournamentSeasonModel->save();

        return $tournamentSeasonModel;
    }

    public static function buildFromSeason(\stdClass $season, int $tournamentId, ?TournamentSeasonAllSports $exitingTournamentSeason = null): TournamentSeasonAllSports
    {
        if ($exitingTournamentSeason) {
            $tournamentSeasonModel = $exitingTournamentSeason;
        } else {
            $tournamentSeasonModel = new TournamentSeasonAllSports;
        }

        $tournamentSeasonModel->name = $season->name;
        $tournamentSeasonModel->import_id = $season->id;
        $tournamentSeasonModel->slug = $season->slug ?? '';
        $tournamentSeasonModel->tournament_id = $tournamentId;
        $tournamentSeasonModel->year = $season->year;

        return $tournamentSeasonModel;
    }
}
