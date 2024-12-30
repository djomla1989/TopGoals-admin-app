<?php

namespace App\Services\DataImporters\Mappers;

use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TournamentTeamPlayersMapper extends AbstractModelMapper implements ModelMapperInterface
{
    const SIMILARITY_THRESHOLD = 60;
    const BIRTHDAY_SIMILARITY_INCREMENT = 30;
    /**
     * @param Team $model
     * @param array $data
     * @return array
     */
    public function mapByNames(Model $model, array $data): array
    {
        if (!$this->supportsModel($model)) {
            throw new \InvalidArgumentException(sprintf('Invalid model %s for Tournament Team Player mapper', get_class($model)));
        }

        $playerList = $this->getPlayerList($model);
        $nameSimilarity = $this->calculateNameAndBirthSimilarities($playerList, $data);
        $priorityList = $this->buildPriorityList($nameSimilarity);

        return $this->mapTeams($priorityList, $playerList, $data);
    }

    protected function calculateNameAndBirthSimilarities(array $modelList, array $data): array
    {
        $nameSimilarity = [];

        foreach ($modelList as $id => $playerData) {
            foreach ($data as $key => $importPlayer) {

                similar_text(strtolower($playerData['name']), strtolower($importPlayer['name']), $similarity);
                similar_text(strtolower($importPlayer['name']), strtolower($playerData['name']), $similaritySecond);
                $similarity = max($similarity, $similaritySecond);
                $importDob = $this->extractBirthdateToTimestamp($importPlayer['dob'] ?? null);

                if ($similarity > self::SIMILARITY_THRESHOLD && $playerData['dob'] && $importDob) {
                    /** @var Carbon $playerDob */
                    $playerDob = $playerData['dob'];
                    $timestamp = $playerDob->startOfDay()->timestamp;
                    if ($timestamp === $importDob) {
                        $similarity += self::BIRTHDAY_SIMILARITY_INCREMENT;
                    }
                }
                $nameSimilarity[$id][$key] = $similarity;
            }
        }

        return $nameSimilarity;
    }

    protected function getPlayerList(Team $model): array
    {
        return $model->players->mapWithKeys(fn($player) => [$player->id => [
            'name' => $player->name,
            'dob' => $player->date_of_birth
        ]])->toArray();
    }

    public function supportsModel(Model $model): bool
    {
        return $model instanceof Team;
    }

    function extractBirthdateToTimestamp(string $input): ?int
    {
        $pattern = '/\((\d{4}[-\.\/]\d{1,2}[-\.\/]\d{1,2}|\d{1,2}[-\.\/]\d{1,2}[-\.\/]\d{4})\)/';

        if (preg_match($pattern, $input, $matches)) {
            $dateString = $matches[1];
            $dob = str_replace(['.', '/'], '-', $dateString);
            // Date format
            if (preg_match('/^\d{4}[-\.\/]\d{1,2}[-\.\/]\d{1,2}$/', $dateString)) {
                // Format: YYYY-MM-DD
                $date = Carbon::createFromFormat('Y-m-d', $dob);
            } elseif (preg_match('/^\d{1,2}[-\.\/]\d{1,2}[-\.\/]\d{4}$/', $dateString)) {
                // Format: DD-MM-YYYY
                $date = Carbon::createFromFormat('d-m-Y', $dob);
            } else {
                return null;
            }

            return $date ? $date->startOfDay()->timestamp : null;
        }

        return null;
    }
}
