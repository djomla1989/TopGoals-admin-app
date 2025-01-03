<?php

namespace Database\Factories;

use App\Models\AllSports\TeamAllSports;
use App\Models\AllSports\TournamentSeasonAllSports;
use App\Models\AllSports\TournamentSeasonNextEventAllSports;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AllSports\TournamentSeasonNextEventAllSports>
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
        \stdClass                  $nextEvent,
        TournamentSeasonAllSports  $tournamentSeason,
        int                        $tournamentSeasonGroupId,
        TeamAllSports              $homeTeam,
        TeamAllSports              $awayTeam,
        ?TournamentSeasonNextEventAllSports $existingNextEvent = null
    ): array {

        $data = [
            'customId' => $nextEvent->customId,
            'slug' => $nextEvent->slug,
            'import_id' => $nextEvent->id,
            'home_team_name' => $homeTeam->name,
            'home_team_id' => $homeTeam->id,
            'away_team_name' => $awayTeam->name,
            'away_team_id' => $awayTeam->id,
            'start_timestamp' => ($nextEvent->startTimestamp > 0 && $nextEvent->startTimestamp < 2147483647) ? $nextEvent->startTimestamp : strtotime('1970-01-01'),
            'tournament_season_id' => $tournamentSeason->id,
            'tournament_season_group_id' => $tournamentSeasonGroupId,
            'tournament_id' => $tournamentSeason->tournament->id,
            'category_id' => $tournamentSeason->tournament->category->id,
            'sport_id' => $tournamentSeason->tournament->sport->id,
            'round' => $nextEvent?->roundInfo?->round ?? 0,
            'status' => $nextEvent->status->type,
        ];

        if ($existingNextEvent) {
            $data['id'] = $existingNextEvent->id;
        }

        return $data;
    }
}
