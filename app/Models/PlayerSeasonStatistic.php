<?php

namespace App\Models;

use App\Casts\Integer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $player_id
 * @property int $season_id
 * @property int $source_id
 * @property string $type
 * @property int|null $appearances
 * @property mixed $rating
 * @property int|null $goals
 * @property mixed $expected_goals
 * @property int|null $assists
 * @property mixed $expected_assists
 * @property int|null $goals_assists_sum
 * @property int|null $penalties_taken
 * @property int|null $penalty_goals
 * @property int|null $free_kick_taken
 * @property int|null $free_kick_goal
 * @property int|null $scoring_frequency
 * @property int|null $total_shots
 * @property int|null $shots_on_target
 * @property int|null $big_chances_missed
 * @property int|null $big_chances_created
 * @property int|null $accurate_passes
 * @property mixed $accurate_passes_percentage
 * @property int|null $key_passes
 * @property int|null $accurate_long_balls
 * @property int|null $successful_dribbles
 * @property mixed $successful_dribbles_percentage
 * @property int|null $penalty_won
 * @property int|null $tackles
 * @property int|null $interceptions
 * @property int|null $clearances
 * @property int|null $possession_lost
 * @property int|null $yellow_cards
 * @property int|null $red_cards
 * @property int|null $saves
 * @property mixed $goals_prevented
 * @property int|null $most_conceded
 * @property int|null $least_conceded
 * @property int|null $clean_sheet
 * @property Player $player
 * @property Season $season
 */
class PlayerSeasonStatistic extends BaseModel
{
    protected $fillable = [
        'player_id',
        'season_id',
        'source_id',
        'type',
        'appearances',
        'rating',
        'goals',
        'expected_goals',
        'assists',
        'expected_assists',
        'goals_assists_sum',
        'penalties_taken',
        'penalty_goals',
        'free_kick_taken',
        'free_kick_goal',
        'scoring_frequency',
        'total_shots',
        'shots_on_target',
        'big_chances_missed',
        'big_chances_created',
        'accurate_passes',
        'accurate_passes_percentage',
        'key_passes',
        'accurate_long_balls',
        'successful_dribbles',
        'successful_dribbles_percentage',
        'penalty_won',
        'tackles',
        'interceptions',
        'clearances',
        'possession_lost',
        'yellow_cards',
        'red_cards',
        'saves',
        'goals_prevented',
        'most_conceded',
        'least_conceded',
        'clean_sheet',
    ];

    protected $casts = [
        'rating' => Integer::class,
        'expected_goals' => Integer::class,
        'expected_assists' => Integer::class,
        'accurate_passes_percentage' => Integer::class,
        'goals_prevented' => Integer::class,
        'successful_dribbles_percentage' => Integer::class,
    ];

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function setPlayer(Player $player): self
    {
        $this->player()->associate($player);
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

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }

    public function setAppearances(?int $appearances): self
    {
        $this->appearances = $appearances;
        return $this;
    }

    public function setRating(mixed $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function setGoals(?int $goals): self
    {
        $this->goals = $goals;
        return $this;
    }

    public function setExpectedGoals(mixed $expectedGoals): self
    {
        $this->expected_goals = $expectedGoals;
        return $this;
    }

    public function setAssists(?int $assists): self
    {
        $this->assists = $assists;
        return $this;
    }

    public function setExpectedAssists(mixed $expectedAssists): self
    {
        $this->expected_assists = $expectedAssists;
        return $this;
    }

    public function setGoalsAssistsSum(?int $goalsAssistsSum): self
    {
        $this->goals_assists_sum = $goalsAssistsSum;
        return $this;
    }

    public function setPenaltiesTaken(?int $penaltiesTaken): self
    {
        $this->penalties_taken = $penaltiesTaken;
        return $this;
    }

    public function setPenaltyGoals(?int $penaltyGoals): self
    {
        $this->penalty_goals = $penaltyGoals;
        return $this;
    }

    public function setFreeKickTaken(?int $freeKickTaken): self
    {
        $this->free_kick_taken = $freeKickTaken;
        return $this;
    }

    public function setFreeKickGoal(?int $freeKickGoal): self
    {
        $this->free_kick_goal = $freeKickGoal;
        return $this;
    }

    public function setScoringFrequency(?int $scoringFrequency): self
    {
        $this->scoring_frequency = $scoringFrequency;
        return $this;
    }

    public function setTotalShots(?int $totalShots): self
    {
        $this->total_shots = $totalShots;
        return $this;
    }

    public function setShotsOnTarget(?int $shotsOnTarget): self
    {
        $this->shots_on_target = $shotsOnTarget;
        return $this;
    }

    public function setBigChancesMissed(?int $bigChancesMissed): self
    {
        $this->big_chances_missed = $bigChancesMissed;
        return $this;
    }

    public function setBigChancesCreated(?int $bigChancesCreated): self
    {
        $this->big_chances_created = $bigChancesCreated;
        return $this;
    }

    public function setAccuratePasses(?int $accuratePasses): self
    {
        $this->accurate_passes = $accuratePasses;
        return $this;
    }

    public function setAccuratePassesPercentage(mixed $accuratePassesPercentage): self
    {
        $this->accurate_passes_percentage = $accuratePassesPercentage;
        return $this;
    }

    public function setKeyPasses(?int $keyPasses): self
    {
        $this->key_passes = $keyPasses;
        return $this;
    }

    public function setAccurateLongBalls(?int $accurateLongBalls): self
    {
        $this->accurate_long_balls = $accurateLongBalls;
        return $this;
    }

    public function setSuccessfulDribbles(?int $successfulDribbles): self
    {
        $this->successful_dribbles = $successfulDribbles;
        return $this;
    }

    public function setSuccessfulDribblesPercentage(mixed $successfulDribblesPercentage): self
    {
        $this->successful_dribbles_percentage = $successfulDribblesPercentage;
        return $this;
    }

    public function setPenaltyWon(?int $penaltyWon): self
    {
        $this->penalty_won = $penaltyWon;
        return $this;
    }

    public function setTackles(?int $tackles): self
    {
        $this->tackles = $tackles;
        return $this;
    }

    public function setInterceptions(?int $interceptions): self
    {
        $this->interceptions = $interceptions;
        return $this;
    }

    public function setClearances(?int $clearances): self
    {
        $this->clearances = $clearances;
        return $this;
    }

    public function setPossessionLost(?int $possessionLost): self
    {
        $this->possession_lost = $possessionLost;
        return $this;
    }

    public function setYellowCards(?int $yellowCards): self
    {
        $this->yellow_cards = $yellowCards;
        return $this;
    }

    public function setRedCards(?int $redCards): self
    {
        $this->red_cards = $redCards;
        return $this;
    }

    public function setSaves(?int $saves): self
    {
        $this->saves = $saves;
        return $this;
    }

    public function setGoalsPrevented(mixed $goalsPrevented): self
    {
        $this->goals_prevented = $goalsPrevented;
        return $this;
    }

    public function setMostConceded(?int $mostConceded): self
    {
        $this->most_conceded = $mostConceded;
        return $this;
    }

    public function setLeastConceded(?int $leastConceded): self
    {
        $this->least_conceded = $leastConceded;
        return $this;
    }

    public function setCleanSheet(?int $cleanSheet): self
    {
        $this->clean_sheet = $cleanSheet;
        return $this;
    }
}
