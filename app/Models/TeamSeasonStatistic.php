<?php

namespace App\Models;

use App\Casts\Integer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $team_id
 * @property int $season_id
 * @property int $source_id
 * @property string $type
 * @property int|null $matches
 * @property int|null $awarded_matches
 * @property int|null $goals_scored
 * @property int|null $goals_conceded
 * @property int|null $own_goals
 * @property int|null $assists
 * @property int|null $shots
 * @property int|null $penalty_goals
 * @property int|null $penalties_taken
 * @property int|null $free_kick_goals
 * @property int|null $free_kick_shots
 * @property int|null $goals_from_inside_the_box
 * @property int|null $goals_from_outside_the_box
 * @property int|null $shots_from_inside_the_box
 * @property int|null $shots_from_outside_the_box
 * @property int|null $headed_goals
 * @property int|null $left_foot_goals
 * @property int|null $right_foot_goals
 * @property int|null $big_chances
 * @property int|null $big_chances_created
 * @property int|null $big_chances_missed
 * @property int|null $shots_on_target
 * @property int|null $shots_off_target
 * @property int|null $blocked_scoring_attempt
 * @property int|null $successful_dribbles
 * @property int|null $dribble_attempts
 * @property int|null $corners
 * @property int|null $hit_woodwork
 * @property int|null $fast_breaks
 * @property int|null $fast_break_goals
 * @property int|null $fast_break_shots
 * @property int|null $average_ball_possession
 * @property int|null $total_passes
 * @property int|null $accurate_passes
 * @property int|null $accurate_passes_percentage
 * @property int|null $total_own_half_passes
 * @property int|null $accurate_own_half_passes
 * @property int|null $accurate_own_half_passes_percentage
 * @property int|null $total_opposition_half_passes
 * @property int|null $accurate_opposition_half_passes
 * @property int|null $accurate_opposition_half_passes_percentage
 * @property int|null $total_long_balls
 * @property int|null $accurate_long_balls
 * @property int|null $accurate_long_balls_percentage
 * @property int|null $total_crosses
 * @property int|null $accurate_crosses
 * @property int|null $accurate_crosses_percentage
 * @property int|null $clean_sheets
 * @property int|null $tackles
 * @property int|null $interceptions
 * @property int|null $saves
 * @property int|null $errors_leading_to_goal
 * @property int|null $errors_leading_to_shot
 * @property int|null $penalties_commited
 * @property int|null $penalty_goals_conceded
 * @property int|null $clearances
 * @property int|null $clearances_off_line
 * @property int|null $last_man_tackles
 * @property int|null $total_duels
 * @property int|null $duels_won
 * @property int|null $duels_won_percentage
 * @property int|null $total_ground_duels
 * @property int|null $ground_duels_won
 * @property int|null $ground_duels_won_percentage
 * @property int|null $total_aerial_duels
 * @property int|null $aerial_duels_won
 * @property int|null $aerial_duels_won_percentage
 * @property int|null $possession_lost
 * @property int|null $offsides
 * @property int|null $fouls
 * @property int|null $yellow_cards
 * @property int|null $yellow_red_cards
 * @property int|null $red_cards
 * @property int|null $avg_rating
 * @property int|null $accurate_final_third_passes_against
 * @property int|null $accurate_opposition_half_passes_against
 * @property int|null $accurate_own_half_passes_against
 * @property int|null $accurate_passes_against
 * @property int|null $big_chances_against
 * @property int|null $big_chances_created_against
 * @property int|null $big_chances_missed_against
 * @property int|null $clearances_against
 * @property int|null $corners_against
 * @property int|null $crosses_successful_against
 * @property int|null $crosses_total_against
 * @property int|null $dribble_attempts_total_against
 * @property int|null $dribble_attempts_won_against
 * @property int|null $errors_leading_to_goal_against
 * @property int|null $errors_leading_to_shot_against
 * @property int|null $hit_woodwork_against
 * @property int|null $interceptions_against
 * @property int|null $key_passes_against
 * @property int|null $long_balls_successful_against
 * @property int|null $long_balls_total_against
 * @property int|null $offsides_against
 * @property int|null $red_cards_against
 * @property int|null $shots_against
 * @property int|null $shots_blocked_against
 * @property int|null $shots_from_inside_the_box_against
 * @property int|null $shots_from_outside_the_box_against
 * @property int|null $shots_off_target_against
 * @property int|null $shots_on_target_against
 * @property int|null $blocked_scoring_attempt_against
 * @property int|null $tackles_against
 * @property int|null $total_final_third_passes_against
 * @property int|null $opposition_half_passes_total_against
 * @property int|null $own_half_passes_total_against
 * @property int|null $total_passes_against
 * @property int|null $yellow_cards_against
 * @property Team $team
 * @property Season $season
 */
class TeamSeasonStatistic extends BaseModel
{
    protected $fillable = [
        'team_id',
        'season_id',
        'source_id',
        'type',
        'matches',
        'awarded_matches',
        'goals_scored',
        'goals_conceded',
        'own_goals',
        'assists',
        'shots',
        'penalty_goals',
        'penalties_taken',
        'free_kick_goals',
        'free_kick_shots',
        'goals_from_inside_the_box',
        'goals_from_outside_the_box',
        'shots_from_inside_the_box',
        'shots_from_outside_the_box',
        'headed_goals',
        'left_foot_goals',
        'right_foot_goals',
        'big_chances',
        'big_chances_created',
        'big_chances_missed',
        'shots_on_target',
        'shots_off_target',
        'blocked_scoring_attempt',
        'successful_dribbles',
        'dribble_attempts',
        'corners',
        'hit_woodwork',
        'fast_breaks',
        'fast_break_goals',
        'fast_break_shots',
        'average_ball_possession',
        'total_passes',
        'accurate_passes',
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
        'clean_sheets',
        'tackles',
        'interceptions',
        'saves',
        'errors_leading_to_goal',
        'errors_leading_to_shot',
        'penalties_commited',
        'penalty_goals_conceded',
        'clearances',
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
        'fouls',
        'yellow_cards',
        'yellow_red_cards',
        'red_cards',
        'avg_rating',
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
        'yellow_cards_against'
    ];

    protected $casts = [
        'average_ball_possession' => Integer::class,
        'accurate_passes_percentage' => Integer::class,
        'accurate_own_half_passes_percentage' => Integer::class,
        'accurate_opposition_half_passes_percentage' => Integer::class,
        'accurate_long_balls_percentage' => Integer::class,
        'accurate_crosses_percentage' => Integer::class,
        'duels_won_percentage' => Integer::class,
        'ground_duels_won_percentage' => Integer::class,
        'aerial_duels_won_percentage' => Integer::class,
        'avg_rating' => Integer::class
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function setTeam(Team $team): self
    {
        $this->team()->associate($team);
        return $this;
    }

    public function setSeason(Season $season): self
    {
        $this->season()->associate($season);
        return $this;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;
        return $this;
    }
}
