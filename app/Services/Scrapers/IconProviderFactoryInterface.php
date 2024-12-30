<?php

namespace App\Services\Scrapers;

use Illuminate\Database\Eloquent\Model;

interface IconProviderFactoryInterface
{
    public function getModelProviders(Model $model): array;
}
