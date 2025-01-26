<?php

namespace App\Builder\Player;

use App\Models\Player;
use App\Models\Sport;
use App\Utils\DateTimeHelper;
use Carbon\Carbon;

class PlayerBuilder
{
    public static function build(array $data, Sport $sport): Player
    {
        /** @var Player $player */
        $player = Player::firstOrNew([
            'source_id' => $data['id'],
        ]);

        $player->setSport($sport);
        $player->setName($data['name'] ?? '');
        $player->setSlug($data['slug'] ?? '');
        $player->setJerseyNumber($data['jerseyNumber'] ?? '');
        $player->setDateOfBirth(Carbon::parse($data['dateOfBirthTimestamp'] ?? '', DateTimeHelper::DEFAULT_TIMEZONE));
        $player->setGender($data['gender'] ?? 'M');
        $player->setPosition($data['position'] ?? '');
        $player->setHeight($data['height'] ?? null);
        $player->setWeight($data['weight'] ?? null);
        $player->setCountryCode($data['country']['alpha2'] ?? '');

        return $player;
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
