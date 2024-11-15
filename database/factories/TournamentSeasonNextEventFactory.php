<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\TournamentSeason;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TournamentSeasonNextEvent>
 */
class TournamentSeasonNextEventFactory extends Factory
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

    public static function buildArrayFromNextEvent(
        \stdClass $nextEvent,
        TournamentSeason $tournamentSeason,
        Team $homeTeam,
        Team $awayTeam
    ): array {
        return [
            'customId' => $nextEvent->customId,
            'slug' => $nextEvent->slug,
            'import_id' => $nextEvent->id,
            'home_team_name' => $homeTeam->name,
            'home_team_id' => $homeTeam->id,
            'away_team_name' => $awayTeam->name,
            'away_team_id' => $awayTeam->id,
            'start_timestamp' => $nextEvent->startTimestamp,
            'tournament_season_id' => $tournamentSeason->id,
            'tournament_id' => $tournamentSeason->tournament->id,
            'country_id' => $tournamentSeason->tournament->country->id,
            'sport_id' => $tournamentSeason->tournament->sport->id,
            'round' => $nextEvent?->roundInfo?->round ?? 0,
            'status' => $nextEvent->status->type,
        ];
    }
}
