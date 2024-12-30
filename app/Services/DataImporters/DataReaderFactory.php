<?php

namespace App\Services\DataImporters;

use App\Services\DataImporters\Providers\DataReaderInterface;
use App\Services\DataImporters\Providers\FlashScoreDataReader;

class DataReaderFactory implements DataReaderFactoryInterface
{
    const FLASHSCORE_PROVIDER = 'flashscore';

    public static function create(string $sourceProvider): DataReaderInterface
    {
        return match ($sourceProvider) {
            self::FLASHSCORE_PROVIDER => new FlashScoreDataReader(),
            default => throw new \InvalidArgumentException(sprintf('Invalid source provider %s', $sourceProvider)),
        };
    }
}
