<?php

namespace App\Services\Scrapers\Team;

use App\Models\Team;
use App\Services\Scrapers\IconProviderInterface;

interface TeamtIconProviderFactoryInterface
{
    /**
     * @param Team $team
     * @return IconProviderInterface[] array
     */
    public function getProviders(Team $team): array;
}
