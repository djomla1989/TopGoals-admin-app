<?php

namespace App\Builder\Season;

use App\Models\SeasonStandingGroup;
use App\Models\SeasonStandingGroupTeam;
use App\Models\Team;

class SeasonStandingGroupTeamBuilder
{
    public static function build(SeasonStandingGroup $seasonStandingGroup, Team $team, array $data): SeasonStandingGroupTeam
    {
        /** @var SeasonStandingGroupTeam $seasonStandingGroupTeam */
        $seasonStandingGroupTeam = SeasonStandingGroupTeam::firstOrNew([
            'season_standing_group_id' => $seasonStandingGroup->getId(),
            'team_id' => $team->getId(),
        ]);

        $seasonStandingGroupTeam->setSourceId($data['id']);
        $seasonStandingGroupTeam->setPosition($data['position'] ?? null);
        $seasonStandingGroupTeam->setSeasonStandingGroup($seasonStandingGroup);
        $seasonStandingGroupTeam->setTeam($team);
        $seasonStandingGroupTeam->setPoints($data['points'] ?? null);
        $seasonStandingGroupTeam->setMatches($data['matches'] ?? null);
        $seasonStandingGroupTeam->setWins($data['wins'] ?? null);
        $seasonStandingGroupTeam->setDraws($data['draws'] ?? null);
        $seasonStandingGroupTeam->setLosses($data['losses'] ?? null);
        $seasonStandingGroupTeam->setScoresFor($data['scoresFor'] ?? null);
        $seasonStandingGroupTeam->setScoresAgainst($data['scoresAgainst'] ?? null);
        $seasonStandingGroupTeam->setGoalDifference($data['scoreDiffFormatted'] ?? null);
        $seasonStandingGroupTeam->setPromotion($data['promotion']['text'] ?? '');

        return $seasonStandingGroupTeam;
    }
}
