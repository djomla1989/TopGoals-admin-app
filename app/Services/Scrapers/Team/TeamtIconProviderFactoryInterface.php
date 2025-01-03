<?php

namespace App\Services\Scrapers\Team;

use App\Models\AllSports\TeamAllSports;
use App\Services\Scrapers\IconProviderInterface;

interface TeamtIconProviderFactoryInterface
{
    /**
     * @param TeamAllSports $team
     * @return IconProviderInterface[] array
     */
    public function getProviders(TeamAllSports $team): array;
}
