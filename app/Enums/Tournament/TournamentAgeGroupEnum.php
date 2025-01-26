<?php

namespace App\Enums\Tournament;

enum TournamentAgeGroupEnum: string
{
    case U17 = 'U17';
    case U18 = 'U18';
    case U19 = 'U19';
    case U20 = 'U20';
    case U21 = 'U21';
    case U22 = 'U22';
    case U23 = 'U23';
    case SENIOR = 'Senior';
    case VETERAN = 'Veteran';

    public static function resolveAgeGroup(string $ageGroup): TournamentAgeGroupEnum
    {
        $ageGroup = strtoupper($ageGroup);

        foreach (TournamentAgeGroupEnum::cases() as $enumCase) {
            if (str_contains($ageGroup, $enumCase->value)) {
                return $enumCase;
            }
        }

        return TournamentAgeGroupEnum::SENIOR;
    }
}
