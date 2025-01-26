<?php

namespace App\Builder\Match;

use App\Models\MatchEvent;
use App\Models\Season;
use App\Models\Team;
use App\Utils\DateTimeHelper;
use Carbon\Carbon;

class MatchBuilder
{
    public static function buildFromEvent(array $data, Season $season, Team $homeTeam, Team $awayTeam): MatchEvent
    {
        $sport = $season->tournament->sport;

        /** @var MatchEvent $match */
        $match = MatchEvent::firstOrNew(['source_id' => $data['id']]);

        $match->setSport($sport);
        $match->setSourceId($data['id']);
        $match->setCustomMatchId($data['customId']);
        $match->setSlug($data['slug']);
        $match->setHomeTeam($homeTeam);
        $match->setAwayTeam($awayTeam);
        $match->setSeason($season);
        $match->setRound($data['roundInfo']['round']);
        $match->setHomeScore((int)$data['homeScore']['current']);
        $match->setAwayScore((int)$data['awayScore']['current']);
        $match->setStatus($data['status']['type']);
        $match->setStartDate(Carbon::parse($data['startTimestamp'], DateTimeHelper::DEFAULT_TIMEZONE));

        if ($data['winnerCode'] === 1) {
            $match->setWinner($homeTeam);
        } elseif ($data['winnerCode'] === 2) {
            $match->setWinner($awayTeam);
        }

        return $match;
    }
}
