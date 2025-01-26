<?php

namespace App\Models;

use App\Casts\Integer;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SeasonTeamStatistic
 * @package App\Models
 *
 * @property int $id
 * @property int $season_id
 * @property int $team_id
 * @property int $matches
 * @property int $avg_rating
 * @property int $goals_scored
 * @property int $goals_conceded
 * @property int $big_chances
 * @property int $big_chances_missed
 * @property int $hit_woodwork
 * @property int $yellow_cards
 * @property int $red_cards
 * @property int $average_ball_possession
 * @property int $accurate_passes
 * @property int $accurate_long_balls
 * @property int $accurate_crosses
 * @property int $shots
 * @property int $shots_on_target
 * @property int $successful_dribbles
 * @property int $tackles
 * @property int $interceptions
 * @property int $clearances
 * @property int $corners
 * @property int $fouls
 * @property int $penalties_taken
 * @property int $penalty_goals
 * @property int $penalties_committed
 * @property int $penalty_goals_conceded
 * @property int $clean_sheets
 * @property int $own_goals
 * @property int $assists
 * @property int $free_kick_goals
 * @property int $free_kick_shots
 * @property int $goals_from_inside_the_box
 * @property int $goals_from_outside_the_box
 * @property int $shots_from_inside_the_box
 * @property int $shots_from_outside_the_box
 * @property int $headed_goals
 * @property int $left_foot_goals
 * @property int $right_foot_goals
 * @property int $big_chances_created
 * @property int $shots_off_target
 * @property int $blocked_scoring_attempt
 * @property int $dribble_attempts
 * @property int $fast_breaks
 * @property int $fast_break_goals
 * @property int $fast_break_shots
 * @property int $total_passes
 * @property int $accurate_passes_percentage
 * @property int $total_own_half_passes
 * @property int $accurate_own_half_passes
 * @property int $accurate_own_half_passes_percentage
 * @property int $total_opposition_half_passes
 * @property int $accurate_opposition_half_passes
 * @property int $accurate_opposition_half_passes_percentage
 * @property int $total_long_balls
 * @property int $accurate_long_balls_percentage
 * @property int $total_crosses
 * @property int $accurate_crosses_percentage
 * @property int $saves
 * @property int $errors_leading_to_goal
 * @property int $errors_leading_to_shot
 * @property int $clearances_off_line
 * @property int $last_man_tackles
 * @property int $total_duels
 * @property int $duels_won
 * @property int $duels_won_percentage
 * @property int $total_ground_duels
 * @property int $ground_duels_won
 * @property int $ground_duels_won_percentage
 * @property int $total_aerial_duels
 * @property int $aerial_duels_won
 * @property int $aerial_duels_won_percentage
 * @property int $possession_lost
 * @property int $offsides
 * @property int $yellow_red_cards
 * @property int $accurate_final_third_passes_against
 * @property int $accurate_opposition_half_passes_against
 * @property int $accurate_own_half_passes_against
 * @property int $accurate_passes_against
 * @property int $big_chances_against
 * @property int $big_chances_created_against
 * @property int $big_chances_missed_against
 * @property int $clearances_against
 * @property int $corners_against
 * @property int $crosses_successful_against
 * @property int $crosses_total_against
 * @property int $dribble_attempts_total_against
 * @property int $dribble_attempts_won_against
 * @property int $errors_leading_to_goal_against
 * @property int $errors_leading_to_shot_against
 * @property int $hit_woodwork_against
 * @property int $interceptions_against
 * @property int $key_passes_against
 * @property int $long_balls_successful_against
 * @property int $long_balls_total_against
 * @property int $offsides_against
 * @property int $red_cards_against
 * @property int $shots_against
 * @property int $shots_blocked_against
 * @property int $shots_from_inside_the_box_against
 * @property int $shots_from_outside_the_box_against
 * @property int $shots_off_target_against
 * @property int $shots_on_target_against
 * @property int $blocked_scoring_attempt_against
 * @property ?\DateTime $last_sync
 * @property Season $season
 * @property Team $team
 */
class SeasonTeamStatistic extends BaseModel
{
    protected $table = 'season_team_statistics';

    protected $fillable = [
        'season_id',
        'team_id',
        'matches',
        'avg_rating',
        'goals_scored',
        'goals_conceded',
        'big_chances',
        'big_chances_missed',
        'hit_woodwork',
        'yellow_cards',
        'red_cards',
        'average_ball_possession',
        'accurate_passes',
        'accurate_crosses',
        'shots',
        'shots_on_target',
        'successful_dribbles',
        'tackles',
        'interceptions',
        'clearances',
        'corners',
        'fouls',
        'penalties_taken',
        'penalty_goals',
        'penalties_committed',
        'penalty_goals_conceded',
        'clean_sheets',
        'own_goals',
        'assists',
        'free_kick_goals',
        'free_kick_shots',
        'goals_from_inside_the_box',
        'goals_from_outside_the_box',
        'shots_from_inside_the_box',
        'shots_from_outside_the_box',
        'headed_goals',
        'left_foot_goals',
        'right_foot_goals',
        'big_chances_created',
        'shots_off_target',
        'blocked_scoring_attempt',
        'dribble_attempts',
        'fast_breaks',
        'fast_break_goals',
        'fast_break_shots',
        'total_passes',
        'accurate_passes_percentage',
        'total_own_half_passes',
        'accurate_own_half_passes',
        'accurate_own_half_passes_percentage',
        'total_opposition_half_passes',
        'accurate_opposition_half_passes',
        'accurate_opposition_half_passes_percentage',
        'total_long_balls',
        'accurate_long_balls',
        'accurate_long_balls_percentage',
        'total_crosses',
        'accurate_crosses',
        'accurate_crosses_percentage',
        'saves',
        'errors_leading_to_goal',
        'errors_leading_to_shot',
        'penalties_committed',
        'clearances_off_line',
        'last_man_tackles',
        'total_duels',
        'duels_won',
        'duels_won_percentage',
        'total_ground_duels',
        'ground_duels_won',
        'ground_duels_won_percentage',
        'total_aerial_duels',
        'aerial_duels_won',
        'aerial_duels_won_percentage',
        'possession_lost',
        'offsides',
        'yellow_red_cards',
        'accurate_final_third_passes_against',
        'accurate_opposition_half_passes_against',
        'accurate_own_half_passes_against',
        'accurate_passes_against',
        'big_chances_against',
        'big_chances_created_against',
        'big_chances_missed_against',
        'clearances_against',
        'corners_against',
        'crosses_successful_against',
        'crosses_total_against',
        'dribble_attempts_total_against',
        'dribble_attempts_won_against',
        'errors_leading_to_goal_against',
        'errors_leading_to_shot_against',
        'hit_woodwork_against',
        'interceptions_against',
        'key_passes_against',
        'long_balls_successful_against',
        'long_balls_total_against',
        'offsides_against',
        'red_cards_against',
        'shots_against',
        'shots_blocked_against',
        'shots_from_inside_the_box_against',
        'shots_from_outside_the_box_against',
        'shots_off_target_against',
        'shots_on_target_against',
        'blocked_scoring_attempt_against',
        'tackles_against',
        'total_final_third_passes_against',
        'opposition_half_passes_total_against',
        'own_half_passes_total_against',
        'total_passes_against',
        'yellow_cards_against',
        'last_sync'
    ];


    protected $casts = [
        'avg_rating' => Integer::class,
        'average_ball_possession' => Integer::class,
        'overall_ball_possession' => Integer::class,
        'accurate_passes_percentage' => Integer::class,
        'accurate_own_half_passes_percentage' => Integer::class,
        'accurate_opposition_half_passes_percentage' => Integer::class,
        'accurate_long_balls_percentage' => Integer::class,
        'accurate_crosses_percentage' => Integer::class,
        'duels_won_percentage' => Integer::class,
        'ground_duels_won_percentage' => Integer::class,
        'aerial_duels_won_percentage' => Integer::class,
        'last_sync' => 'datetime',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function setSeason(Season $season): self
    {
        $this->season()->associate($season);
        return $this;
    }

    public function setTeam(Team $team): self
    {
        $this->team()->associate($team);
        return $this;
    }
}
