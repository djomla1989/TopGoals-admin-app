<?php

namespace App\Builder\Tournament;

use App\Enums\Gender;
use App\Enums\Tournament\TournamentAgeGroupEnum;
use App\Models\Sport;
use App\Models\Tournament;
use Carbon\Carbon;

class TournamentBuilder
{
    public static function build(Sport $sport, array $data): Tournament
    {
        /** @var Tournament $tournament */
        $tournament = Tournament::firstOrNew(
            [
                'source_id' => $data['id']
            ]
        );

        $tournament->setSport($sport);

        if (!empty($data['startDateTimestamp'])) {
            $tournament->setStartDate(Carbon::createFromTimestamp($data['startDateTimestamp']));
        }

        if (!empty($data['endDateTimestamp'])) {
            $tournament->setEndDate(Carbon::createFromTimestamp($data['endDateTimestamp']));
        }

        $tournament->setGender(Gender::resolveGender($data['gender'] ?? '', $data['name'])->value);
        $tournament->setAgeGroup(TournamentAgeGroupEnum::resolveAgeGroup($data['name'] ?? '')->value);
        $tournament->setTier($data['tier'] ?? null);
        $tournament->setNational($data['national'] ?? false);
        $tournament->setHasGroups($data['hasGroups'] ?? false);

        return $tournament;
    }
}
