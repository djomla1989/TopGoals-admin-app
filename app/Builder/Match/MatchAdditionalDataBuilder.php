<?php

namespace App\Builder\Match;

use App\Models\MatchAdditionalData;
use App\Models\MatchEvent;

class MatchAdditionalDataBuilder
{
    public static function buildFromEvent(array $data, MatchEvent $match): MatchAdditionalData
    {
        /** @var MatchAdditionalData $matchAdditionalData */
        $matchAdditionalData = MatchAdditionalData::firstOrNew(['match_id' => $match->getId()]);

        $matchAdditionalData->setMatch($match);
        $matchAdditionalData->setHasGlobalHighlights($data['hasGlobalHighlights']);
        $matchAdditionalData->setHasXg($data['hasXg']);
        $matchAdditionalData->setHasEventPlayerStatistics($data['hasEventPlayerStatistics']);
        $matchAdditionalData->setHasEventPlayerHeatMap($data['hasEventPlayerHeatMap']);
        $matchAdditionalData->setWinnerCode($data['winnerCode'] ?? null);
        $matchAdditionalData->setInjuryTime1($data['time']['injuryTime1'] ?? null);
        $matchAdditionalData->setInjuryTime2($data['time']['injuryTime2'] ?? null);
        $matchAdditionalData->setHomeScorePeriod1($data['homeScore']['period1'] ?? null);
        $matchAdditionalData->setHomeScorePeriod2($data['homeScore']['period2'] ?? null);
        $matchAdditionalData->setAwayScorePeriod1($data['awayScore']['period1'] ?? null);
        $matchAdditionalData->setAwayScorePeriod2($data['awayScore']['period2'] ?? null);

        return $matchAdditionalData;
    }
}
