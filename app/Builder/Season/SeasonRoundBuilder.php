<?php

namespace App\Builder\Season;

use App\Models\Season;
use App\Models\SeasonRound;
use App\Models\SeasonStatistic;

class SeasonRoundBuilder
{
    public static function build(Season $season, array $data): SeasonRound
    {
        /** @var SeasonRound $seasonRound */
        $seasonRound = SeasonRound::firstOrNew([
            'season_id' => $season->id,
            'source_id' => $data['id'],
        ]);

        $seasonRound->setSeason($season)
            ->setSourceId($data['id'])
            ->setName($data['roundName'] ?? '')
            ->setSlug($data['roundSlug'] ?? '')
            ->setRoundNumber($data['roundId']);

        return $seasonRound;
    }
}
