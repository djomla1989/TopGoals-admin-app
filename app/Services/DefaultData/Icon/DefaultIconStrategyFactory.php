<?php

namespace App\Services\DefaultData\Icon;

use App\Models\Team;
use App\Models\Tournament;
use App\Services\DefaultData\Exception\DefaultDataModelNotSupportedException;
use Illuminate\Database\Eloquent\Model;

class DefaultIconStrategyFactory implements DefaultIconStrategyFactoryInterface
{
    /**
     * @throws DefaultDataModelNotSupportedException
     */
    public function getStrategyForModel(Model $model): DefaultIconStrategyInterface
    {
        return match (true) {
            $model instanceof Tournament => new TournamentDefaultIconStrategy(),
            $model instanceof Team => new TeamDefaultIconStrategy(),
            default => throw new DefaultDataModelNotSupportedException(
                sprintf('Model %s not supported :: %s', get_class($model), __FILE__)
            )
        };
    }
}
