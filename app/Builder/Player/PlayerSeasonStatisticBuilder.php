<?php

namespace App\Builder\Player;

use App\Models\Player;
use App\Models\PlayerSeasonStatistic;
use App\Models\Season;
use App\Models\Sport;
use App\Utils\DateTimeHelper;
use Carbon\Carbon;

class PlayerSeasonStatisticBuilder
{
    public static function build(Player $player, Season $season, array $data): PlayerSeasonStatistic
    {
        /** @var PlayerSeasonStatistic $playerSeasonStatistic */
        $playerSeasonStatistic = PlayerSeasonStatistic::firstOrNew([
            'player_id' => $player->getId(),
            'season_id' => $season->getId(),
        ]);

        $playerSeasonStatistic->setPlayer($player);
        $playerSeasonStatistic->setSeason($season);
        $playerSeasonStatistic->setSourceId($data['id']);
        $playerSeasonStatistic->setType($data['type']);
        $playerSeasonStatistic->setAppearances($data['appearances'] ?? null);
        $playerSeasonStatistic->setRating($data['rating'] ?? null);
        $playerSeasonStatistic->setGoals($data['goals'] ?? null);
        $playerSeasonStatistic->setExpectedGoals($data['expectedGoals'] ?? null);
        $playerSeasonStatistic->setAssists($data['assists'] ?? null);
        $playerSeasonStatistic->setExpectedAssists($data['expectedAssists'] ?? null);
        $playerSeasonStatistic->setGoalsAssistsSum($data['goalsAssistsSum'] ?? null);
        $playerSeasonStatistic->setPenaltiesTaken($data['penaltiesTaken'] ?? null);
        $playerSeasonStatistic->setPenaltyGoals($data['penaltyGoals'] ?? null);
        $playerSeasonStatistic->setFreeKickTaken($data['shotFromSetPiece'] ?? null);
        $playerSeasonStatistic->setFreeKickGoal($data['freeKickGoal'] ?? null);
        $playerSeasonStatistic->setScoringFrequency($data['scoringFrequency'] ?? null);
        $playerSeasonStatistic->setTotalShots($data['totalShots'] ?? null);
        $playerSeasonStatistic->setShotsOnTarget($data['shotsOnTarget'] ?? null);
        $playerSeasonStatistic->setBigChancesMissed($data['bigChancesMissed'] ?? null);
        $playerSeasonStatistic->setBigChancesCreated($data['bigChancesCreated'] ?? null);
        $playerSeasonStatistic->setAccuratePasses($data['accuratePasses'] ?? null);
        $playerSeasonStatistic->setAccuratePassesPercentage($data['accuratePassesPercentage'] ?? null);
        $playerSeasonStatistic->setKeyPasses($data['keyPasses'] ?? null);
        $playerSeasonStatistic->setAccurateLongBalls($data['accurateLongBalls'] ?? null);
        $playerSeasonStatistic->setSuccessfulDribbles($data['successfulDribbles'] ?? null);
        $playerSeasonStatistic->setSuccessfulDribblesPercentage($data['successfulDribblesPercentage'] ?? null);
        $playerSeasonStatistic->setPenaltyWon($data['penaltyWon'] ?? null);
        $playerSeasonStatistic->setTackles($data['tackles'] ?? null);
        $playerSeasonStatistic->setInterceptions($data['interceptions'] ?? null);
        $playerSeasonStatistic->setClearances($data['clearances'] ?? null);
        $playerSeasonStatistic->setPossessionLost($data['possessionLost'] ?? null);
        $playerSeasonStatistic->setYellowCards($data['yellowCards'] ?? null);
        $playerSeasonStatistic->setRedCards($data['redCards'] ?? null);
        $playerSeasonStatistic->setSaves($data['saves'] ?? null);
        $playerSeasonStatistic->setGoalsPrevented($data['goalsPrevented'] ?? null);
        $playerSeasonStatistic->setMostConceded($data['mostConceded'] ?? null);
        $playerSeasonStatistic->setLeastConceded($data['leastConceded'] ?? null);
        $playerSeasonStatistic->setCleanSheet($data['cleanSheet'] ?? null);

        return $playerSeasonStatistic;
    }


}
