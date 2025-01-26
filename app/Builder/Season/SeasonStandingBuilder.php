<?php

namespace App\Builder\Season;


use App\Models\Season;
use App\Models\SeasonStanding;

class SeasonStandingBuilder
{
    public static function build(Season $season, string $standingType): SeasonStanding
    {
        /** @var SeasonStanding $seasonStanding */
        $seasonStanding = SeasonStanding::firstOrNew([
            'season_id' => $season->getId(),
            'type' => $standingType,
        ]);

        $seasonStanding->setSeason($season);
        $seasonStanding->setType($standingType);

        return $seasonStanding;
    }

}
