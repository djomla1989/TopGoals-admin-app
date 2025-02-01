<?php

namespace App\Builder\Match;

use App\Enums\Match\MatchStatusCodeEnum;
use App\Models\MatchEvent;
use App\Models\Season;
use App\Models\Team;
use App\Utils\DateTimeHelper;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        $match->setHomeScore($data['homeScore']['current'] ?? null);
        $match->setAwayScore($data['awayScore']['current'] ?? null);
        $match->setStatus(Str::snake($data['status']['type'] ?? ''));
        $match->setMatchStatus(Str::snake($data['status']['description'] ?? ''));
        $match->setStartDate(Carbon::parse($data['startTimestamp'], DateTimeHelper::DEFAULT_TIMEZONE));

        if ($data['status']['code'] === MatchStatusCodeEnum::NOT_STARTED->value && isset($data['winnerCode'])) {
            if ($data['winnerCode'] === 1) {
                $match->setWinner($homeTeam);
            } elseif ($data['winnerCode'] === 2) {
                $match->setWinner($awayTeam);
            }
        }

        return $match;
    }
}
