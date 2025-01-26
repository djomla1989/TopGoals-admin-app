<?php

namespace App\Builder\Season;

use App\Models\SeasonStanding;
use App\Models\SeasonStandingGroup;

class SeasonStandingGroupBuilder
{
    public static function build(SeasonStanding $seasonStanding, array $data): SeasonStandingGroup
    {
        /** @var SeasonStandingGroup $seasonStandingGroup */
        $seasonStandingGroup = SeasonStandingGroup::firstOrNew([
            'season_standing_id' => $seasonStanding->getId(),
            'name' => $data['name'] ?? '',
        ]);

        $seasonStandingGroup->setSourceId($data['id']);
        $seasonStandingGroup->setSeasonStanding($seasonStanding);
        $seasonStandingGroup->setName($data['name'] ?? '');
        $seasonStandingGroup->setTieBreakingRule($data['tieBreakingRule']['text'] ?? '');

        return $seasonStandingGroup;
    }

}
