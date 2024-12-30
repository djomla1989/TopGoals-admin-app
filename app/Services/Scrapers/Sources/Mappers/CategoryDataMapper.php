<?php

namespace App\Services\Scrapers\Sources\Mappers;

use App\Services\Scrapers\Sources\DTO\CategoryDTO;
use App\Services\Scrapers\Sources\DTO\DataDTOInterface;

class CategoryDataMapper implements DataMapperInterface
{
    public function map(array $data, array $keyMap): DataDTOInterface
    {
        return new CategoryDTO(
            id: $data[$keyMap['id']],
            name: $data[$keyMap['name']],
            sport: $data[$keyMap['sport']],
            slug: $data[$keyMap['slug']],
            url: $data[$keyMap['url']],
            countryCode: $data[$keyMap['countryCode']],
            iconUrl: $data[$keyMap['iconUrl']],
        );
    }
}
