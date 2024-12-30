<?php

namespace App\Services\Scrapers\Sources\Mappers;

use App\Services\Scrapers\Sources\DTO\DataDTOInterface;
use App\Services\Scrapers\Sources\DTO\SportDTO;

class SportDataMapper implements DataMapperInterface
{
    public function map(array $data, array $keyMap): DataDTOInterface
    {
        return new SportDTO(
            id: $data[$keyMap['id']],
            name: $data[$keyMap['name']],
            slug: $data[$keyMap['slug']],
            url: $data[$keyMap['url']],
            iconUrl: $data[$keyMap['iconUrl']],
        );
    }

}
