<?php

namespace App\Builder\Team;

use App\Models\Season;
use App\Models\Sport;
use App\Models\Team;
use App\Models\TeamSeasonStatistic;

class TeamSeasonStatisticBuilder
{
    public static function build(Team $team, Season $season, array $data): TeamSeasonStatistic
    {
        /** @var TeamSeasonStatistic $teamSeasonStatistic */
        $teamSeasonStatistic = TeamSeasonStatistic::firstOrNew(
            [
                'team_id' => $team->getId(),
                'season_id' => $season->getId(),
            ]
        );

        $teamSeasonStatistic->setTeam($team);
        $teamSeasonStatistic->setSeason($season);
        $teamSeasonStatistic->setSourceId($data['id']);
        $teamSeasonStatistic->type = $data['type'];
        $teamSeasonStatistic->matches = $data['matches'] ?? null;
        $teamSeasonStatistic->awarded_matches = $data['awardedMatches'] ?? null;
        $teamSeasonStatistic->goals_scored = $data['goalsScored'] ?? null;
        $teamSeasonStatistic->goals_conceded = $data['goalsConceded'] ?? null;
        $teamSeasonStatistic->own_goals = $data['ownGoals'] ?? null;
        $teamSeasonStatistic->assists = $data['assists'] ?? null;
        $teamSeasonStatistic->shots = $data['shots'] ?? null;
        $teamSeasonStatistic->penalty_goals = $data['penaltyGoals'] ?? null;
        $teamSeasonStatistic->penalties_taken = $data['penaltiesTaken'] ?? null;
        $teamSeasonStatistic->free_kick_goals = $data['freeKickGoals'] ?? null;
        $teamSeasonStatistic->free_kick_shots = $data['freeKickShots'] ?? null;
        $teamSeasonStatistic->goals_from_inside_the_box = $data['goalsFromInsideTheBox'] ?? null;
        $teamSeasonStatistic->goals_from_outside_the_box = $data['goalsFromOutsideTheBox'] ?? null;
        $teamSeasonStatistic->shots_from_inside_the_box = $data['shotsFromInsideTheBox'] ?? null;
        $teamSeasonStatistic->shots_from_outside_the_box = $data['shotsFromOutsideTheBox'] ?? null;
        $teamSeasonStatistic->headed_goals = $data['headedGoals'] ?? null;
        $teamSeasonStatistic->left_foot_goals = $data['leftFootGoals'] ?? null;
        $teamSeasonStatistic->right_foot_goals = $data['rightFootGoals'] ?? null;
        $teamSeasonStatistic->big_chances = $data['bigChances'] ?? null;
        $teamSeasonStatistic->big_chances_created = $data['bigChancesCreated'] ?? null;
        $teamSeasonStatistic->big_chances_missed = $data['bigChancesMissed'] ?? null;
        $teamSeasonStatistic->shots_on_target = $data['shotsOnTarget'] ?? null;
        $teamSeasonStatistic->shots_off_target = $data['shotsOffTarget'] ?? null;
        $teamSeasonStatistic->blocked_scoring_attempt = $data['blockedScoringAttempt'] ?? null;
        $teamSeasonStatistic->successful_dribbles = $data['successfulDribbles'] ?? null;
        $teamSeasonStatistic->dribble_attempts = $data['dribbleAttempts'] ?? null;
        $teamSeasonStatistic->corners = $data['corners'] ?? null;
        $teamSeasonStatistic->hit_woodwork = $data['hitWoodwork'] ?? null;
        $teamSeasonStatistic->fast_breaks = $data['fastBreaks'] ?? null;
        $teamSeasonStatistic->fast_break_goals = $data['fastBreakGoals'] ?? null;
        $teamSeasonStatistic->fast_break_shots = $data['fastBreakShots'] ?? null;
        $teamSeasonStatistic->average_ball_possession = $data['averageBallPossession'] ?? null;
        $teamSeasonStatistic->total_passes = $data['totalPasses'] ?? null;
        $teamSeasonStatistic->accurate_passes = $data['accuratePasses'] ?? null;
        $teamSeasonStatistic->accurate_passes_percentage = $data['accuratePassesPercentage'] ?? null;
        $teamSeasonStatistic->total_own_half_passes = $data['totalOwnHalfPasses'] ?? null;
        $teamSeasonStatistic->accurate_own_half_passes = $data['accurateOwnHalfPasses'] ?? null;
        $teamSeasonStatistic->accurate_own_half_passes_percentage = $data['accurateOwnHalfPassesPercentage'] ?? null;
        $teamSeasonStatistic->total_opposition_half_passes = $data['totalOppositionHalfPasses'] ?? null;
        $teamSeasonStatistic->accurate_opposition_half_passes = $data['accurateOppositionHalfPasses'] ?? null;
        $teamSeasonStatistic->accurate_opposition_half_passes_percentage = $data['accurateOppositionHalfPassesPercentage'] ?? null;
        $teamSeasonStatistic->total_long_balls = $data['totalLongBalls'] ?? null;
        $teamSeasonStatistic->accurate_long_balls = $data['accurateLongBalls'] ?? null;
        $teamSeasonStatistic->accurate_long_balls_percentage = $data['accurateLongBallsPercentage'] ?? null;
        $teamSeasonStatistic->total_crosses = $data['totalCrosses'] ?? null;
        $teamSeasonStatistic->accurate_crosses = $data['accurateCrosses'] ?? null;
        $teamSeasonStatistic->accurate_crosses_percentage = $data['accurateCrossesPercentage'] ?? null;
        $teamSeasonStatistic->clean_sheets = $data['cleanSheets'] ?? null;
        $teamSeasonStatistic->tackles = $data['tackles'] ?? null;
        $teamSeasonStatistic->interceptions = $data['interceptions'] ?? null;
        $teamSeasonStatistic->saves = $data['saves'] ?? null;
        $teamSeasonStatistic->errors_leading_to_goal = $data['errorsLeadingToGoal'] ?? null;
        $teamSeasonStatistic->errors_leading_to_shot = $data['errorsLeadingToShot'] ?? null;
        $teamSeasonStatistic->penalties_commited = $data['penaltiesCommited'] ?? null;
        $teamSeasonStatistic->penalty_goals_conceded = $data['penaltyGoalsConceded'] ?? null;
        $teamSeasonStatistic->clearances = $data['clearances'] ?? null;
        $teamSeasonStatistic->clearances_off_line = $data['clearancesOffLine'] ?? null;
        $teamSeasonStatistic->last_man_tackles = $data['lastManTackles'] ?? null;
        $teamSeasonStatistic->total_duels = $data['totalDuels'] ?? null;
        $teamSeasonStatistic->duels_won = $data['duelsWon'] ?? null;
        $teamSeasonStatistic->duels_won_percentage = $data['duelsWonPercentage'] ?? null;
        $teamSeasonStatistic->total_ground_duels = $data['totalGroundDuels'] ?? null;
        $teamSeasonStatistic->ground_duels_won = $data['groundDuelsWon'] ?? null;
        $teamSeasonStatistic->ground_duels_won_percentage = $data['groundDuelsWonPercentage'] ?? null;
        $teamSeasonStatistic->total_aerial_duels = $data['totalAerialDuels'] ?? null;
        $teamSeasonStatistic->aerial_duels_won = $data['aerialDuelsWon'] ?? null;
        $teamSeasonStatistic->aerial_duels_won_percentage = $data['aerialDuelsWonPercentage'] ?? null;
        $teamSeasonStatistic->possession_lost = $data['possessionLost'] ?? null;
        $teamSeasonStatistic->offsides = $data['offsides'] ?? null;
        $teamSeasonStatistic->fouls = $data['fouls'] ?? null;
        $teamSeasonStatistic->yellow_cards = $data['yellowCards'] ?? null;
        $teamSeasonStatistic->yellow_red_cards = $data['yellowRedCards'] ?? null;
        $teamSeasonStatistic->red_cards = $data['redCards'] ?? null;
        $teamSeasonStatistic->avg_rating = $data['avgRating'] ?? null;
        $teamSeasonStatistic->accurate_final_third_passes_against = $data['accurateFinalThirdPassesAgainst'] ?? null;
        $teamSeasonStatistic->accurate_opposition_half_passes_against = $data['accurateOppositionHalfPassesAgainst'] ?? null;
        $teamSeasonStatistic->accurate_own_half_passes_against = $data['accurateOwnHalfPassesAgainst'] ?? null;
        $teamSeasonStatistic->accurate_passes_against = $data['accuratePassesAgainst'] ?? null;
        $teamSeasonStatistic->big_chances_against = $data['bigChancesAgainst'] ?? null;
        $teamSeasonStatistic->big_chances_created_against = $data['bigChancesCreatedAgainst'] ?? null;
        $teamSeasonStatistic->big_chances_missed_against = $data['bigChancesMissedAgainst'] ?? null;
        $teamSeasonStatistic->clearances_against = $data['clearancesAgainst'] ?? null;
        $teamSeasonStatistic->corners_against = $data['cornersAgainst'] ?? null;
        $teamSeasonStatistic->crosses_successful_against = $data['crossesSuccessfulAgainst'] ?? null;
        $teamSeasonStatistic->crosses_total_against = $data['crossesTotalAgainst'] ?? null;
        $teamSeasonStatistic->dribble_attempts_total_against = $data['dribbleAttemptsTotalAgainst'] ?? null;
        $teamSeasonStatistic->dribble_attempts_won_against = $data['dribbleAttemptsWonAgainst'] ?? null;
        $teamSeasonStatistic->errors_leading_to_goal_against = $data['errorsLeadingToGoalAgainst'] ?? null;
        $teamSeasonStatistic->errors_leading_to_shot_against = $data['errorsLeadingToShotAgainst'] ?? null;
        $teamSeasonStatistic->hit_woodwork_against = $data['hitWoodworkAgainst'] ?? null;
        $teamSeasonStatistic->interceptions_against = $data['interceptionsAgainst'] ?? null;
        $teamSeasonStatistic->key_passes_against = $data['keyPassesAgainst'] ?? null;
        $teamSeasonStatistic->long_balls_successful_against = $data['longBallsSuccessfulAgainst'] ?? null;
        $teamSeasonStatistic->long_balls_total_against = $data['longBallsTotalAgainst'] ?? null;
        $teamSeasonStatistic->offsides_against = $data['offsidesAgainst'] ?? null;
        $teamSeasonStatistic->red_cards_against = $data['redCardsAgainst'] ?? null;
        $teamSeasonStatistic->shots_against = $data['shotsAgainst'] ?? null;
        $teamSeasonStatistic->shots_blocked_against = $data['shotsBlockedAgainst'] ?? null;
        $teamSeasonStatistic->shots_from_inside_the_box_against = $data['shotsFromInsideTheBoxAgainst'] ?? null;
        $teamSeasonStatistic->shots_from_outside_the_box_against = $data['shotsFromOutsideTheBoxAgainst'] ?? null;
        $teamSeasonStatistic->shots_off_target_against = $data['shotsOffTargetAgainst'] ?? null;
        $teamSeasonStatistic->shots_on_target_against = $data['shotsOnTargetAgainst'] ?? null;
        $teamSeasonStatistic->blocked_scoring_attempt_against = $data['blockedScoringAttemptAgainst'] ?? null;
        $teamSeasonStatistic->tackles_against = $data['tacklesAgainst'] ?? null;
        $teamSeasonStatistic->total_final_third_passes_against = $data['totalFinalThirdPassesAgainst'] ?? null;
        $teamSeasonStatistic->opposition_half_passes_total_against = $data['oppositionHalfPassesTotalAgainst'] ?? null;
        $teamSeasonStatistic->own_half_passes_total_against = $data['ownHalfPassesTotalAgainst'] ?? null;
        $teamSeasonStatistic->total_passes_against = $data['totalPassesAgainst'] ?? null;
        $teamSeasonStatistic->yellow_cards_against = $data['yellowCardsAgainst'] ?? null;

        return $teamSeasonStatistic;
    }
}
