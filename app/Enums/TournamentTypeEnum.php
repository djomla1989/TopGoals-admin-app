<?php

namespace App\Enums;

enum TournamentTypeEnum : string
{
    case LEAGUE = 'league';
    case KNOCKOUT = 'knockout';
    case TOURNAMENT = 'tournament';
    case CUP = 'cup';
    case SUPER_CUP = 'super-cup';
    case FRIENDLY = 'friendly';
    case QUALIFYING_CUP = 'qualifying-cup';
    case QUALIFYING_TOURNAMENT = 'qualifying-tournament';

    public function label(): string
    {
        return match($this) {
            self::LEAGUE => 'League',
            self::KNOCKOUT => 'Knockout',
            self::TOURNAMENT => 'Tournament',
            self::CUP => 'Cup',
            self::SUPER_CUP => 'Super Cup',
            self::FRIENDLY => 'Friendly',
            self::QUALIFYING_CUP => 'Qualifying Cup',
            self::QUALIFYING_TOURNAMENT => 'Qualifying Tournament',
        };
    }
}
