<?php

namespace App\Builder\Match;

use App\Models\MatchEvent;
use App\Models\MatchLineup;
use App\Models\MatchLineupPlayer;
use App\Models\Player;
use App\Models\Team;

class MatchLineupPlayerBuilder
{
    public static function build(array $data, MatchLineup $matchLineup, Player $player, bool $missing = false, ?string $reason = null): MatchLineupPlayer
    {
        /** @var MatchLineupPlayer $matchLineupPlayer */
        $matchLineupPlayer = MatchLineupPlayer::firstOrNew([
            'match_lineup_id' => $matchLineup->getId(),
            'player_id' => $player->getId(),
        ]);

        $matchLineupPlayer->setPosition($data['position'] ?? null);
        $matchLineupPlayer->setJerseyNumber($data['jerseyNumber'] ?? null);
        $matchLineupPlayer->setIsCaptain($data['captain'] ?? false);
        $matchLineupPlayer->setIsSubstitute($data['substitute'] ?? false);
        $matchLineupPlayer->setIsMissing($missing);
        $matchLineupPlayer->setMissingReason($reason);

        return $matchLineupPlayer;
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
