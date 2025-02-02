<?php

namespace App\Builder\Tournament;

use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentAdditionalData;

class TournamentAdditionalDataBuilder
{
    public static function build(Tournament $tournament, Team $titleHolder, array $data): TournamentAdditionalData
    {
        /** @var TournamentAdditionalData $tournamentAdditionalData */
        $tournamentAdditionalData = TournamentAdditionalData::firstOrNew(
            [
                'tournament_id' => $tournament->getId()
            ]
        );

        $tournamentAdditionalData->setTournament($tournament);
        $tournamentAdditionalData->setTitleHolder($titleHolder);
        $tournamentAdditionalData->setHasPerformanceGraphFeature($data['hasPerformanceGraphFeature'] ?? false);
        $tournamentAdditionalData->setMostTitles($data['mostTitles'] ?? null);
        $tournamentAdditionalData->setPrimaryColorHex($data['primaryColorHex'] ?? null);
        $tournamentAdditionalData->setSecondaryColorHex($data['secondaryColorHex'] ?? null);

        return $tournamentAdditionalData;
    }
}
