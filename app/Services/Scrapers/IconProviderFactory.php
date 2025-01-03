<?php

namespace App\Services\Scrapers;

use App\Models\AllSports\TeamAllSports;
use App\Models\AllSports\TournamentAllSports;
use App\Services\DefaultData\Exception\DefaultDataModelNotSupportedException;
use App\Services\Scrapers\Team\TeamtIconProviderFactoryInterface;
use App\Services\Scrapers\Tournament\Icon\TournamentIconProviderFactoryInterface;
use Illuminate\Database\Eloquent\Model;

class IconProviderFactory implements IconProviderFactoryInterface
{
    protected TournamentIconProviderFactoryInterface $tournamentIconProviderFactory;

    protected TeamtIconProviderFactoryInterface $teamIconProviderFactory;

    public function __construct(
        TournamentIconProviderFactoryInterface $tournamentIconProviderFactory,
        TeamtIconProviderFactoryInterface $teamIconProviderFactory
    )
    {
        $this->tournamentIconProviderFactory = $tournamentIconProviderFactory;
        $this->teamIconProviderFactory = $teamIconProviderFactory;
    }

    /**
     * @param Model $model
     * @return IconProviderInterface[]
     * @throws DefaultDataModelNotSupportedException
     */
    public function getModelProviders(Model $model): array
    {
        return match (true) {
            $model instanceof TournamentAllSports => $this->tournamentIconProviderFactory->getProviders($model),
            $model instanceof TeamAllSports => $this->teamIconProviderFactory->getProviders($model),
            default => throw new DefaultDataModelNotSupportedException(
                sprintf('Model %s not supported :: %s', get_class($model), __FILE__)
            )
        };
    }
}
