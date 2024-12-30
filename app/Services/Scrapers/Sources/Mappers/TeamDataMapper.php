<?php

namespace App\Services\Scrapers\Sources\Mappers;

use App\Services\Scrapers\Sources\DTO\DataDTOInterface;
use App\Services\Scrapers\Sources\DTO\TeamDTO;

class TeamDataMapper
{
    public function map(array $data, array $keyMap): DataDTOInterface
    {
        return new TeamDTO(
            id: $data[$keyMap['id']],
            name: $data[$keyMap['name']],
            sport: $data[$keyMap['sport']],
            category: $data[$keyMap['category']],
            countryCode: $data[$keyMap['countryCode']],
            slug: $data[$keyMap['slug']],
            gender: $data[$keyMap['gender']],
            type: $data[$keyMap['type']],
            url: $data[$keyMap['url']],
            iconUrl: $data[$keyMap['iconUrl']],
        );
    }
}
