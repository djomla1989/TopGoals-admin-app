<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Team>
 */
class TeamFactory extends Factory
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

    public static function buildFromTeam(
        \stdClass $team,
        int $sportId,
        int $categoryId,
        ?int $primaryTournamentId,
        ?Team $existingTeam = null,
    ): Team {
        $teamModel = $existingTeam ?? new Team;

        $teamModel->import_id = $team->id;
        $teamModel->name = $team->name;
        $teamModel->short_name = $team->shortName ?? '';
        $teamModel->code = $team->nameCode ?? '';
        $teamModel->slug = $team->slug ?? '';
        $teamModel->sport_id = $sportId;
        $teamModel->category_id = $categoryId;
        $teamModel->primary_tournament_id = $primaryTournamentId;
        $teamModel->is_national = $team->national ?? false;
        $teamModel->gender = Gender::resolveGender($team?->gender ?? '', $team->name)->value;
        $teamModel->primary_color = $team->teamColors->primary ?? '';

        return $teamModel;
    }
}
