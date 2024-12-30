<?php

namespace App\Services\Scrapers\Sources\Mappers;

use App\Services\Scrapers\Sources\DTO\DataDTOInterface;

interface DataMapperInterface
{
    public function map(array $data, array $keyMap): DataDTOInterface;
}
