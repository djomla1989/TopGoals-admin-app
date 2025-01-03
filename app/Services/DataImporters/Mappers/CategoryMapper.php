<?php

namespace App\Services\DataImporters\Mappers;

use App\Models\AllSports\CategoryAllSports;
use App\Models\AllSports\SportAllSports;
use Illuminate\Database\Eloquent\Model;

class CategoryMapper extends AbstractModelMapper implements ModelMapperInterface
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

        $categoryList = $this->getCategotyList($model);
        $nameSimilarity = $this->calculateNameSimilarities($categoryList, $data);

        $priorityList = $this->buildPriorityList($nameSimilarity);
        return $this->mapObject($priorityList, $categoryList, $data);
    }

    protected function getCategotyList(): array
    {
        return CategoryAllSports::all()->mapWithKeys(fn($team) => [$team->id => $team->name])->toArray();
    }

    public function supportsModel(Model $model): bool
    {
        return $model instanceof SportAllSports;
    }
}
