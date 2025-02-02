<?php

namespace App\Builder\Tournament;

use App\Models\Tournament;
use App\Models\TournamentConnectedTournament;

class TournamentConnectedTournamentBuilder
{
    public static function build(Tournament $tournament, Tournament $connectedTournament, string $type): TournamentConnectedTournament
    {
        /** @var TournamentConnectedTournament $tournamentConnectedTournament */
        $tournamentConnectedTournament = TournamentConnectedTournament::firstOrNew(
            [
                'tournament_id' => $tournament->getId(),
                'connected_tournament_id' => $connectedTournament->getId(),
            ]
        );

        $tournamentConnectedTournament->setTournament($tournament);
        $tournamentConnectedTournament->setConnectedTournament($connectedTournament);
        $tournamentConnectedTournament->setType($type);

        return $tournamentConnectedTournament;
    }
}
