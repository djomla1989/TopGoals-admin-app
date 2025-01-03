<?php

namespace Database\Factories;

use App\Models\AllSports\TournamentSeasonGroupAllSports;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AllSports\TournamentSeasonGroupAllSports>
 */
class TournamentSeasonGroupFactory extends Factory
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

    public static function buildFromTournamentGroup(
        \stdClass                       $group,
        int                             $tournamentId,
        int                             $tournamentSeasonId,
        ?TournamentSeasonGroupAllSports $existingGroup = null
    ): TournamentSeasonGroupAllSports {
        $tournamentSeasonGroupModel = $existingGroup ?? new TournamentSeasonGroupAllSports;

        $tournamentSeasonGroupModel->import_id = $group->id;
        $tournamentSeasonGroupModel->name = $group->name;
        $tournamentSeasonGroupModel->slug = $group->slug;
        $tournamentSeasonGroupModel->group_name = $group->groupName ?? null;
        $tournamentSeasonGroupModel->tournament_id = $tournamentId;
        $tournamentSeasonGroupModel->tournament_season_id = $tournamentSeasonId;
        $tournamentSeasonGroupModel->is_group = $group->isGroup;
        $tournamentSeasonGroupModel->priority = $group->priority;

        return $tournamentSeasonGroupModel;
    }
}
