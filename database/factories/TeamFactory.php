<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Models\Team;
use App\Models\TournamentSeason;
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

    public static function buildFromNextEventTeam(\stdClass $team, TournamentSeason $season): Team
    {
        $teamModel = new Team();

        $teamModel->name = $team->name;
        $teamModel->slug = $team->slug;
        $teamModel->code = $team->nameCode;
        $teamModel->short_name = $team->shortName;
        $teamModel->import_id = $team->id;
        $teamModel->sport_id = $season->tournament->sport_id;
        $teamModel->country_id = $season->tournament->country_id;
        $teamModel->primary_tournament_id = $season->tournament_id;
        $teamModel->is_national = $team->national;
        $teamModel->gender = Gender::resolveGender($team?->gender ?? '', $team->name);
        $teamModel->primary_color = $team?->teamColor?->primary ?? '';

        return $teamModel;
    }
}
