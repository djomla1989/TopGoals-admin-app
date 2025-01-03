<?php

namespace App\Services\DefaultData\Icon;

use App\Models\AllSports\TeamAllSports;
use App\Models\AllSports\TournamentAllSports;
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
            $model instanceof TournamentAllSports => new TournamentDefaultIconStrategy(),
            $model instanceof TeamAllSports => new TeamDefaultIconStrategy(),
            default => throw new DefaultDataModelNotSupportedException(
                sprintf('Model %s not supported :: %s', get_class($model), __FILE__)
            )
        };
    }
}
