<?php

namespace App\Services\Scrapers\Sources\Mappers;

use App\Services\Scrapers\Sources\DTO\DataDTOInterface;
use App\Services\Scrapers\Sources\DTO\TournamentDTO;

class TournamentDataMapper implements DataMapperInterface
{
    public function map(array $data, array $keyMap): DataDTOInterface
    {
        return new TournamentDTO(
            id: $data[$keyMap['id']],
            name: $data[$keyMap['name']],
            sport: $data[$keyMap['sport']],
            slug: $data[$keyMap['slug']],
            category: $data[$keyMap['category']],
            gender: $data[$keyMap['gender']],
            type: $data[$keyMap['type']],
            url: $data[$keyMap['url']],
            iconUrl: $data[$keyMap['iconUrl']],
        );
    }
}
