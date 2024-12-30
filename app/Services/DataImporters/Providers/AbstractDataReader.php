<?php

namespace App\Services\DataImporters\Providers;

abstract class AbstractDataReader implements DataReaderInterface
{
    public function read(string $filePath): array
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        return match ($extension) {
            'csv' => $this->readCsv($filePath),
            'xlsx' => $this->readExcel($filePath),
            default => throw new \InvalidArgumentException('Invalid file extension'),
        };
    }

    abstract function readCsv(string $filePath): array;

    abstract function readExcel(string $filePath): array;
}
