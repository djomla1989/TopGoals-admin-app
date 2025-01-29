<?php

namespace App\Builder\Season;

use App\Models\SeasonRound;
use App\Models\SeasonRoundTeamOfTheWeek;

class SeasonRoundTeamOfTheWeekBuilder
{
    public static function build(SeasonRound $seasonRound, array $data): SeasonRoundTeamOfTheWeek
    {
        /** @var SeasonRoundTeamOfTheWeek $seasonRoundTeamOfTheWeek */
        $seasonRoundTeamOfTheWeek = SeasonRoundTeamOfTheWeek::firstOrNew([
            'season_round_id' => $seasonRound->getId(),
        ]);

        $seasonRoundTeamOfTheWeek->setFormation($data['formation'] ?? '')
            ->setSeasonRound($seasonRound);

        return $seasonRoundTeamOfTheWeek;
    }
}
