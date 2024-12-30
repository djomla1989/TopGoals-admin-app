<?php

namespace App\Services\DataImporters\Mappers;

abstract class AbstractModelMapper
{
    const SIMILARITY_THRESHOLD = 70;
    const SIMILARITY_THRESHOLD_SECOND = 50;

    protected function calculateNameSimilarities(array $modelList, array $data): array
    {
        $nameSimilarity = [];

        foreach ($modelList as $id => $modelName) {
            foreach ($data as $key => $importTeam) {
                $explodeModelName = explode(' ', strtolower($modelName));
                $explodeDataName = explode(' ', strtolower($importTeam['name']));

                similar_text(strtolower($modelName), strtolower($importTeam['name']), $similarity);
                similar_text(strtolower($importTeam['name']), strtolower($modelName), $similaritySecond);
                $similarity = max($similarity, $similaritySecond);


                if (count($explodeModelName) === count($explodeDataName)) {
                    if (
                        empty(array_diff($explodeModelName, $explodeDataName)) &&
                        empty(array_diff($explodeDataName, $explodeModelName))
                    ) {
                        $similarity += 10;
                    }
                }

                $nameSimilarity[$id][$key] = $similarity;
            }
        }
        return $nameSimilarity;
    }

    protected function buildPriorityList(array $nameSimilarity): array
    {
        $priorityList = [];
        foreach ($nameSimilarity as $id => $similarities) {
            foreach ($similarities as $key => $similarity) {
                if ($similarity < self::SIMILARITY_THRESHOLD) {
                    continue;
                }
                $priorityList[] = compact('id', 'key', 'similarity');
            }
        }
        // Sort by similarity
        usort($priorityList, fn($a, $b) => $b['similarity'] <=> $a['similarity']);

        return $priorityList;
    }

    protected function mapObject(array $priorityList, array $teamList, array $data): array
    {
        $usedKeys = [];
        $mappedTeams = [];
        foreach ($priorityList as $item) {
            if (count($mappedTeams) === count($teamList) || $item['similarity'] < self::SIMILARITY_THRESHOLD) {
                break;
            }
            if ($item['key'] === 17) {
                $a = 1;
            }

            if (!in_array($item['id'], $usedKeys, true)) {
                $mappedTeams[$item['id']] = $item['key'];
                $usedKeys[] = $item['id'];
            }
        }

        return $this->buildFinalMappedData($mappedTeams, $data);
    }

    protected function buildFinalMappedData(array $mappedTeams, array $data): array
    {
        foreach ($data as $key => $team) {
            if ($id = array_search($key, $mappedTeams, true)) {
                $data[$key]['init_id'] = $id;
            }
        }

        return $data;
    }
}
