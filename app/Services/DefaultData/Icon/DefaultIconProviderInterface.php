<?php

namespace App\Services\DefaultData\Icon;

use Illuminate\Database\Eloquent\Model;

interface DefaultIconProviderInterface
{
    public function getDefaultIcon(Model $model): ?string;
}
