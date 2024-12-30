<?php

namespace App\Services\Scrapers;

use Illuminate\Database\Eloquent\Model;

/**
 * @template T of Model
 */
interface IconProviderInterface
{
    /**
     * @param T $model
     * @return string|null
     */
    public function fetchIconUrl(Model $model): ?string;
}
