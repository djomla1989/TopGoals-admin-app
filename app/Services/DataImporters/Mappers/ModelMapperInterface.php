<?php

namespace App\Services\DataImporters\Mappers;

use Illuminate\Database\Eloquent\Model;

interface ModelMapperInterface
{
    public function mapByNames(Model $model, array $data): array;

    public function supportsModel(Model $model): bool;
}
