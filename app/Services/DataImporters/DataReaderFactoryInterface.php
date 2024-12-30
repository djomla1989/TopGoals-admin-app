<?php

namespace App\Services\DataImporters;

use App\Services\DataImporters\Providers\DataReaderInterface;

interface DataReaderFactoryInterface
{
    public static function create(string $source): DataReaderInterface;
}
