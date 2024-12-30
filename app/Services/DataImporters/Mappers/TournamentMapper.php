<?php

namespace App\Services\DataImporters\Mappers;

use App\Models\Category;
use App\Models\Sport;
use App\Models\Tournament;
use Illuminate\Database\Eloquent\Model;

class TournamentMapper extends AbstractModelMapper implements ModelMapperInterface
{
    /**
     * @param Sport $model
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

    protected function getTournamentList(Category $model): array
    {
        return Tournament::where('category_id', $model->id)->get()->mapWithKeys(fn($team) => [$team->id => $team->name])->toArray();
    }

    public function supportsModel(Model $model): bool
    {
        return $model instanceof Category;
    }
}
