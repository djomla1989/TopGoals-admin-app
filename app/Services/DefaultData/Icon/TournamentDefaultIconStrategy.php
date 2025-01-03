<?php

namespace App\Services\DefaultData\Icon;

use App\Models\AllSports\TournamentAllSports;
use App\Services\DefaultData\Exception\DefaultDataModelNotSupportedException;
use Illuminate\Database\Eloquent\Model;

class TournamentDefaultIconStrategy implements DefaultIconStrategyInterface
{
    const TOURNAMENT_IMAGE_FILE_PATH = 'tournaments/';

    const TENNIS_DEFAULT_ICONS = [
        'atp_world_tour_finals' => 'atp_world_tour_finals.png',
        'atp_next_generation' => 'atp_next_generation.png',
        'atp_250' => 'atp_250.png',
        'atp_500' => 'atp_500.png',
        'atp_1000' => 'atp_1000.png',
        'grand_slam' => 'grand_slam.png',
        'wta_125' => 'wta_125.png',
        'wta_250' => 'wta_250.png',
        'wta_500' => 'wta_500.png',
        'wta_1000' => 'wta_1000.png',
        'wta_finals' => 'wta_finals.png',
        'wta_premier' => 'wta_premier.png',
        'wta_international' => 'wta_international.png',
        'wta_elite_trophy' => 'wta_elite_trophy.png',
        'wta_championships' => 'wta_championships.png',
        'itf-' => 'itf.png',
        'atp-challenger' => 'atp-challenger.png',
        'atp-' => 'atp.png',
        'wta-' => 'wta.png',
        'default' => 'tennis.png',
    ];

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

        if ($model->sport->id == 'tennis') {
            return self::TOURNAMENT_IMAGE_FILE_PATH . $model->sport->id . "/". $this->getTennisDefaultIcon($model);
        }

        return null;
    }


    protected function getTennisDefaultIcon(TournamentAllSports $model): string
    {
        $slug = $model->slug;
        $level = $model->level;

        if (in_array($level, self::TENNIS_DEFAULT_ICONS)) {
            return self::TENNIS_DEFAULT_ICONS[$level];
        }

        foreach (self::TENNIS_DEFAULT_ICONS as $key => $value) {
            if (starts_with($slug, $key)) {
                return $value;
            }
        }

        return self::TENNIS_DEFAULT_ICONS['default'];
    }

    public function supports(Model $model): bool
    {
        return $model instanceof TournamentAllSports;
    }
}
