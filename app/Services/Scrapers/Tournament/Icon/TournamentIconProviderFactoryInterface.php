<?php

namespace App\Services\Scrapers\Tournament\Icon;

use App\Models\AllSports\TournamentAllSports;
use App\Services\Scrapers\IconProviderInterface;

interface TournamentIconProviderFactoryInterface
{
    /**
     * @param TournamentAllSports $tournament
     * @return IconProviderInterface[] array
     */
    public function getProviders(TournamentAllSports $tournament): array;
}
