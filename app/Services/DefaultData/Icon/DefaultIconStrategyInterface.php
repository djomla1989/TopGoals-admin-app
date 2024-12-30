<?php

namespace App\Services\DefaultData\Icon;

use Illuminate\Database\Eloquent\Model;

interface DefaultIconStrategyInterface
{
    public function getDefaultIcon(Model $model): ?string;

    public function supports(Model $model): bool;
}
