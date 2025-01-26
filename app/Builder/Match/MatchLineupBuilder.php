<?php

namespace App\Builder\Match;

use App\Models\MatchEvent;
use App\Models\MatchLineup;
use App\Models\Team;

class MatchLineupBuilder
{
    public static function build(array $data, MatchEvent $matchEvent, Team $team): MatchLineup
    {
        /** @var MatchLineup $matchTeamLineup */
        $matchTeamLineup = MatchLineup::firstOrNew([
            'match_id' => $matchEvent->getId(),
            'team_id' => $team->getId(),
        ]);

        $matchTeamLineup->setMatch($matchEvent);
        $matchTeamLineup->setTeam($team);
        $matchTeamLineup->setFormation($data['formation'] ?? '');
        $matchTeamLineup->setJerseyPrimary($data['playerColor']['primary'] ?? '');
        $matchTeamLineup->setNumber($data['playerColor']['number'] ?? '');
        $matchTeamLineup->setJerseyOutline($data['playerColor']['outline'] ?? '');
        $matchTeamLineup->setFancyNumber($data['playerColor']['fancyNumber'] ?? '');
        $matchTeamLineup->setGoalkeeperJerseyPrimary($data['goalkeeperColor']['primary'] ?? '');
        $matchTeamLineup->setGoalkeeperNumber($data['goalkeeperColor']['number'] ?? '');
        $matchTeamLineup->setGoalkeeperJerseyOutline($data['goalkeeperColor']['outline'] ?? '');
        $matchTeamLineup->setGoalkeeperFancyNumber($data['goalkeeperColor']['fancyNumber'] ?? '');

        return $matchTeamLineup;
    }


}
