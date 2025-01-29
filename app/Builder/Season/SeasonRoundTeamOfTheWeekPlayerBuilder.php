<?php

namespace App\Builder\Season;

use App\Models\Player;
use App\Models\SeasonRoundTeamOfTheWeek;
use App\Models\SeasonRoundTeamOfTheWeekPlayer;

class SeasonRoundTeamOfTheWeekPlayerBuilder
{
    public static function build(SeasonRoundTeamOfTheWeek $seasonRoundTeamOfTheWeek, Player $player, array $data): SeasonRoundTeamOfTheWeekPlayer
    {
        /** @var SeasonRoundTeamOfTheWeekPlayer $seasonRoundTeamOfTheWeekPlayer */
        $seasonRoundTeamOfTheWeekPlayer = SeasonRoundTeamOfTheWeekPlayer::firstOrNew([
            'season_round_team_of_the_week_id' => $seasonRoundTeamOfTheWeek->getId(),
            'player_id' => $player->getId(),
        ]);

        $seasonRoundTeamOfTheWeekPlayer->setSourceId($data['id'])
            ->setSeasonRoundTeamOfTheWeek($seasonRoundTeamOfTheWeek)
            ->setPlayer($player)
            ->setPosition($player->getPosition())
            ->setRating($data['rating'] ?? 0);

        return $seasonRoundTeamOfTheWeekPlayer;
    }
}
