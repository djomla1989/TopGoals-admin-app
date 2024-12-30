<?php

namespace App\Services\DataImporters\Providers;

interface DataReaderInterface
{
    public function read(string $filePath): array;
}
