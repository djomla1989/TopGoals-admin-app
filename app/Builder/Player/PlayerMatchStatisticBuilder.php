<?php

namespace App\Builder\Player;

use App\Models\MatchLineupPlayer;
use App\Models\Player;
use App\Models\PlayerDetail;
use App\Models\PlayerMatchStatistic;
use App\Models\Sport;
use App\Utils\DateTimeHelper;
use Carbon\Carbon;

class PlayerMatchStatisticBuilder
{
    public static function build(array $data, MatchLineupPlayer $matchLineupPlayer, Player $player): PlayerMatchStatistic
    {
        /** @var PlayerMatchStatistic $playerMatchStatistic */
        $playerMatchStatistic = Player::firstOrNew([
            'player_match_statistics' => $matchLineupPlayer->getId(),
            'player_id' => $player->getId(),
        ]);

        $playerMatchStatistic->setTotalPass($data['totalPass'] ?? null);
        $playerMatchStatistic->setAccuratePass($data['accuratePass'] ?? null);
        $playerMatchStatistic->setTotalLongBalls($data['totalLongBalls'] ?? null);
        $playerMatchStatistic->setAccurateLongBalls($data['accurateLongBalls'] ?? null);
        $playerMatchStatistic->setAerialWon($data['aerialWon'] ?? null);
        $playerMatchStatistic->setDuelWon($data['duelWon'] ?? null);
        $playerMatchStatistic->setTotalClearance($data['totalClearance'] ?? null);
        $playerMatchStatistic->setErrorLeadToAGoal($data['errorLeadToAGoal'] ?? null);
        $playerMatchStatistic->setGoodHighClaim($data['goodHighClaim'] ?? null);
        $playerMatchStatistic->setSavedShotsFromInsideTheBox($data['savedShotsFromInsideTheBox'] ?? null);
        $playerMatchStatistic->setPenaltySave($data['penaltySave'] ?? null);
        $playerMatchStatistic->setSaves($data['saves'] ?? null);
        $playerMatchStatistic->setTotalKeeperSweeper($data['totalKeeperSweeper'] ?? null);
        $playerMatchStatistic->setAccurateKeeperSweeper($data['accurateKeeperSweeper'] ?? null);
        $playerMatchStatistic->setMinutesPlayed($data['minutesPlayed'] ?? null);
        $playerMatchStatistic->setTouches($data['touches'] ?? null);
        $playerMatchStatistic->setRating($data['rating'] ?? null);
        $playerMatchStatistic->setPossessionLostCtrl($data['possessionLostCtrl'] ?? null);
        $playerMatchStatistic->setGoalsPrevented($data['goalsPrevented'] ?? null);



        return $playerMatchStatistic;
    }

    //"player" => [
    //                                "name" => "Marco Carnesecchi",
    //                                "slug" => "marco-carnesecchi",
    //                                "shortName" => "M. Carnesecchi",
    //                                "position" => "G",
    //                                "jerseyNumber" => "29",
    //                                "height" => 192,
    //                                "userCount" => 1764,
    //                                "id" => 865646,
    //                                "country" => [
    //                                    "alpha2" => "IT",
    //                                    "alpha3" => "ITA",
    //                                    "name" => "Italy",
    //                                    "slug" => "italy",
    //                                ],
    //                                "marketValueCurrency" => "EUR",
    //                                "dateOfBirthTimestamp" => 962409600,
    //                                "proposedMarketValueRaw" => [
    //                                    "value" => 21000000,
    //                                    "currency" => "EUR",
    //                                ],
    //                                "fieldTranslations" => [
    //                                    "nameTranslation" => ["ar" => "ماركو كارنيسكي"],
    //                                    "shortNameTranslation" => ["ar" => "م. كارنيسكي"],
    //                                ],
    //                            ],
    //                            "teamId" => 2686,
    //                            "shirtNumber" => 29,
    //                            "jerseyNumber" => "29",
    //                            "position" => "G",
    //                            "substitute" => false,
    //                            "statistics" => [
    //                                "totalPass" => 22,
    //                                "accuratePass" => 14,
    //                                "totalLongBalls" => 16,
    //                                "accurateLongBalls" => 8,
    //                                "aerialWon" => 1,
    //                                "duelWon" => 1,
    //                                "totalClearance" => 3,
    //                                "errorLeadToAGoal" => 1,
    //                                "goodHighClaim" => 1,
    //                                "savedShotsFromInsideTheBox" => 3,
    //                                "penaltySave" => 1,
    //                                "saves" => 3,
    //                                "totalKeeperSweeper" => 3,
    //                                "accurateKeeperSweeper" => 3,
    //                                "minutesPlayed" => 90,
    //                                "touches" => 32,
    //                                "rating" => 6.3,
    //                                "possessionLostCtrl" => 9,
    //                                "ratingVersions" => [
    //                                    "original" => 6.3,
    //                                    "alternative" => 5.7,
    //                                ],
    //                                "goalsPrevented" => -1.5418,
    //                            ],
}
