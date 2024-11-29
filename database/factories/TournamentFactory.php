<?php

namespace Database\Factories;

use App\Enums\Gender;
use App\Enums\TournamentTypeEnum;
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

    public static function buildFromNextEvent(\stdClass $event, int $sportId, int $categoryId): Tournament
    {
        $tournamentModel = TournamentFactory::buildFromTournament($event->tournament->uniqueTournament, $sportId, $categoryId);
        $tournamentModel->gender = Gender::resolveGender($event->homeTeam->gender ?? '', $event->slug)->value;

        return $tournamentModel;
    }

    public static function buildFromTeam(\stdClass $team, int $sportId, int $categoryId): Tournament
    {
        $tournamentModel = TournamentFactory::buildFromTournament($team->tournament->uniqueTournament, $sportId, $categoryId);
        $tournamentModel->gender = Gender::resolveGender($team?->gender ?? '', $team->name)->value;

        return $tournamentModel;
    }

    public static function buildFromTournament(\stdClass $tournament, int $sportId, int $countryId, ?Tournament $exitingTournament = null): Tournament
    {
        if ($exitingTournament) {
            $tournamentModel = $exitingTournament;
        } else {
            $tournamentModel = new Tournament;
        }

        $tournamentModel->name = $tournament->name;
        $tournamentModel->import_id = $tournament->id;
        $tournamentModel->slug = $tournament->slug ?? '';
        $tournamentModel->sport_id = $sportId;
        $tournamentModel->category_id = $countryId;
        $tournamentModel->gender = Gender::resolveGender($tournament?->gender ?? '', $tournament->name)->value;
        $tournamentModel->type = $tournamentMeta?->competitionType ?? TournamentTypeEnum::LEAGUE->value;

        return $tournamentModel;
    }
}
