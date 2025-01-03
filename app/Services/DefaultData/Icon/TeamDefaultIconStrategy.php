<?php

namespace App\Services\DefaultData\Icon;

use App\Models\AllSports\TeamAllSports;
use App\Models\AllSports\TournamentAllSports;
use App\Services\DefaultData\Exception\DefaultDataModelNotSupportedException;
use Illuminate\Database\Eloquent\Model;

class TeamDefaultIconStrategy implements DefaultIconStrategyInterface
{
    const TEAM_IMAGE_FILE_PATH = 'team/';

    /**
     * @param TournamentAllSports $model
     * @throws DefaultDataModelNotSupportedException
     */
    public function getDefaultIcon(Model $model): ?string
    {
        if (!$this->supports($model)) {
            throw new DefaultDataModelNotSupportedException(sprintf(
                'Model %s not supported ::%s', get_class($model), __FILE__)
            );
        }

        return null;
    }

    public function supports(Model $model): bool
    {
        return $model instanceof TeamAllSports;
    }
}
