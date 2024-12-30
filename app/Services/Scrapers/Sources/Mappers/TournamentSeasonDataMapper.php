<?php

namespace App\Services\Scrapers\Sources\Mappers;

use App\Services\Scrapers\Sources\DTO\DataDTOInterface;
use App\Services\Scrapers\Sources\DTO\TournamentSeasonDTO;

class TournamentSeasonDataMapper implements DataMapperInterface
{
    public function map(array $data, array $keyMap): DataDTOInterface
    {
        return new TournamentSeasonDTO(
            id: $data[$keyMap['id']],
            name: $data[$keyMap['name']],
            url: $data[$keyMap['url']],
            slug: $data[$keyMap['slug']],
            startDate: $data[$keyMap['startDate']],
            endDate: $data[$keyMap['endDate']],
            tournamentId: $data[$keyMap['tournamentId']],
        );
    }
}
