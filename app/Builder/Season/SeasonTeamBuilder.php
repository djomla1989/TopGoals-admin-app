<?php

namespace App\Builder\Season;

use App\Models\Season;
use App\Models\SeasonTeam;
use App\Models\Team;

class SeasonTeamBuilder
{
    public static function build(Season $season, Team $team, bool $upperCome = false, bool $lowerCome = false): SeasonTeam
    {
        /** @var SeasonTeam $seasonTeam */
        $seasonTeam = SeasonTeam::firstOrNew([
            'tournament_id' => $season->tournament_id,
            'season_id' => $season->id,
            'team_id' => $team->id,
        ]);

        $seasonTeam->setNewcomerLower($lowerCome);
        $seasonTeam->setNewcomerUpper($upperCome);

        return $seasonTeam;
    }
}
