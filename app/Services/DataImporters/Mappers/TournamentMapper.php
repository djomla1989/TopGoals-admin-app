<?php

namespace App\Services\DataImporters\Mappers;

use App\Models\AllSports\CategoryAllSports;
use App\Models\AllSports\SportAllSports;
use App\Models\AllSports\TournamentAllSports;
use Illuminate\Database\Eloquent\Model;

class TournamentMapper extends AbstractModelMapper implements ModelMapperInterface
{
    /**
     * @param SportAllSports $model
     * @param array $data
     * @return array
     */
    public function mapByNames(Model $model, array $data): array
    {
        if (!$this->supportsModel($model)) {
            throw new \InvalidArgumentException(sprintf('Invalid model %s for Tournament Team mapper', get_class($model)));
        }

        $tournamentList = $this->getTournamentList($model);

        $nameSimilarity = $this->calculateNameSimilarities($tournamentList, $data);
        $priorityList = $this->buildPriorityList($nameSimilarity);

        return $this->mapObject($priorityList, $tournamentList, $data);
    }

    protected function getTournamentList(CategoryAllSports $model): array
    {
        return TournamentAllSports::where('category_id', $model->id)->get()->mapWithKeys(fn($team) => [$team->id => $team->name])->toArray();
    }

    public function supportsModel(Model $model): bool
    {
        return $model instanceof CategoryAllSports;
    }
}
