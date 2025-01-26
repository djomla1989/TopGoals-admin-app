<?php

namespace App\Builder\Season;

use App\Models\Season;
use App\Models\SeasonStatistic;

class SeasonStatisticBuilder
{
    public static function build(Season $season, array $data): SeasonStatistic
    {
        /** @var SeasonStatistic $seasonStatistic */
        $seasonStatistic = SeasonStatistic::firstOrNew([
            'season_id' => $season->id,
        ]);

        $seasonStatistic->setSeason($season);
        $seasonStatistic->setTournament($season->tournament);
        $seasonStatistic->setGoals($data['goals'] ?? 0);
        $seasonStatistic->setHomeTeamWins($data['homeTeamWins'] ?? 0);
        $seasonStatistic->setAwayTeamWins($data['awayTeamWins'] ?? 0);
        $seasonStatistic->setDraws($data['draws'] ?? 0);
        $seasonStatistic->setYellowCards($data['yellowCards'] ?? 0);
        $seasonStatistic->setRedCards($data['redCards'] ?? 0);
        $seasonStatistic->setNumberOfRounds($data['numberOfRounds'] ?? 0);
        $seasonStatistic->setNumberOfCompetitors($data['numberOfCompetitors'] ?? 0);

        return $seasonStatistic;
    }
}
