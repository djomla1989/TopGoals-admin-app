<?php

namespace App\Services\DataImporters\Mappers;

use App\Models\AllSports\TournamentAllSports;
use Illuminate\Database\Eloquent\Model;

class TournamentTeamMapper extends AbstractModelMapper implements ModelMapperInterface
{
    /**
     * @param TournamentAllSports $model
     * @param array $data
     * @return array
     */
    public function mapByNames(Model $model, array $data): array
    {
        if (!$this->supportsModel($model)) {
            throw new \InvalidArgumentException(sprintf('Invalid model %s for Tournament Team mapper', get_class($model)));
        }

        $teamList = $this->getTeamList($model);
        $nameSimilarity = $this->calculateNameSimilarities($teamList, $data);
        $priorityList = $this->buildPriorityList($nameSimilarity);

        return $this->mapTeams($priorityList, $teamList, $data);
    }

    protected function getTeamList(TournamentAllSports $model): array
    {
        return $model->teams->mapWithKeys(fn($team) => [$team->id => $team->name])->toArray();
    }

    public function supportsModel(Model $model): bool
    {
        return $model instanceof TournamentAllSports;
    }
}
