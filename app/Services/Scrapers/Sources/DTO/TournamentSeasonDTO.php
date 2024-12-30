<?php

namespace App\Services\Scrapers\Sources\DTO;

class TournamentSeasonDTO implements DataDTOInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $url,
        public string $slug,
        public string $startDate,
        public string $endDate,
        public string $tournamentId,
    ){

    }
}
