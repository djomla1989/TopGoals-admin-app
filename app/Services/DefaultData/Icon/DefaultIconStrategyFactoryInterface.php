<?php

namespace App\Services\DefaultData\Icon;

use Illuminate\Database\Eloquent\Model;

interface DefaultIconStrategyFactoryInterface
{
    public function getStrategyForModel(Model $model): DefaultIconStrategyInterface;
}
