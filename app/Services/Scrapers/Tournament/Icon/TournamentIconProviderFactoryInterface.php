<?php

namespace App\Services\Scrapers\Tournament\Icon;

use App\Models\Tournament;
use App\Services\Scrapers\IconProviderInterface;

interface TournamentIconProviderFactoryInterface
{
    /**
     * @param Tournament $tournament
     * @return IconProviderInterface[] array
     */
    public function getProviders(Tournament $tournament): array;
}
