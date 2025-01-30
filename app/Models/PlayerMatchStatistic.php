<?php

namespace App\Models;

use App\Casts\Integer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $match_lineup_players_id
 * @property int $match_id
 * @property int $player_id
 * @property int|null $total_pass
 * @property int|null $accurate_pass
 * @property int|null $total_long_balls
 * @property int|null $accurate_long_balls
 * @property int|null $saved_shots_from_inside_the_box
 * @property int|null $saves
 * @property int|null $minute_played
 * @property int|null $touches
 * @property mixed $rating
 * @property int|null $possession_lost_ctrl
 * @property int|null $rating_versions_original
 * @property int|null $rating_versions_alternative
 * @property mixed $goals_prevented
 * @property int|null $aerial_lost
 * @property int|null $aerial_won
 * @property int|null $duel_lost
 * @property int|null $duel_won
 * @property int|null $dispossessed
 * @property int|null $total_contest
 * @property int|null $big_chance_created
 * @property int|null $big_chance_missed
 * @property int|null $shot_off_target
 * @property int|null $on_target_scoring_attempt
 * @property int|null $hit_woodwork
 * @property int|null $goals
 * @property int|null $total_tackle
 * @property int|null $was_fouled
 * @property int|null $fouls
 * @property int|null $total_offside
 * @property int|null $minutes_played
 * @property mixed $expected_goals
 * @property mixed $expected_assists
 * @property int|null $key_pass
 * @property int|null $penalty_miss
 * @property MatchLineupPlayer $matchLineupPlayer
 * @property Player $player
 */
class PlayerMatchStatistic extends BaseModel
{
    protected $fillable = [
        'match_lineup_players_id',
        'match_id',
        'player_id',
        'total_pass',
        'accurate_pass',
        'total_long_balls',
        'accurate_long_balls',
        'saved_shots_from_inside_the_box',
        'saves',
        'minute_played',
        'touches',
        'rating',
        'possession_lost_ctrl',
        'rating_versions_original',
        'rating_versions_alternative',
        'goals_prevented',
        'aerial_lost',
        'aerial_won',
        'duel_lost',
        'duel_won',
        'dispossessed',
        'total_contest',
        'big_chance_created',
        'big_chance_missed',
        'shot_off_target',
        'on_target_scoring_attempt',
        'hit_woodwork',
        'goals',
        'total_tackle',
        'was_fouled',
        'fouls',
        'total_offside',
        'minutes_played',
        'expected_goals',
        'expected_assists',
        'key_pass',
        'penalty_miss',
    ];

    protected $casts = [
        'rating' => Integer::class,
        'goals_prevented' => Integer::class,
        'expected_goals' => Integer::class,
        'expected_assists' => Integer::class
    ];

    public function matchLineupPlayer(): BelongsTo
    {
        return $this->belongsTo(MatchLineupPlayer::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function setMatchLineupPlayer(MatchLineupPlayer $matchLineupPlayer): self
    {
        $this->matchLineupPlayer()->associate($matchLineupPlayer);
        return $this;
    }

    public function setPlayer(Player $player): self
    {
        $this->player()->associate($player);
        return $this;
    }

    public function setTotalPass(?int $totalPass): self
    {
        $this->total_pass = $totalPass;
        return $this;
    }

    public function setAccuratePass(?int $accuratePass): self
    {
        $this->accurate_pass = $accuratePass;
        return $this;
    }

    public function setTotalLongBalls(?int $totalLongBalls): self
    {
        $this->total_long_balls = $totalLongBalls;
        return $this;
    }

    public function setAccurateLongBalls(?int $accurateLongBalls): self
    {
        $this->accurate_long_balls = $accurateLongBalls;
        return $this;
    }

    public function setSavedShotsFromInsideTheBox(?int $savedShotsFromInsideTheBox): self
    {
        $this->saved_shots_from_inside_the_box = $savedShotsFromInsideTheBox;
        return $this;
    }

    public function setSaves(?int $saves): self
    {
        $this->saves = $saves;
        return $this;
    }

    public function setMinutePlayed(?int $minutePlayed): self
    {
        $this->minute_played = $minutePlayed;
        return $this;
    }

    public function setTouches(?int $touches): self
    {
        $this->touches = $touches;
        return $this;
    }

    public function setRating(mixed $rating): self
    {
        $this->rating = $rating;
        return $this;
    }

    public function setPossessionLostCtrl(?int $possessionLostCtrl): self
    {
        $this->possession_lost_ctrl = $possessionLostCtrl;
        return $this;
    }

    public function setRatingVersionsOriginal(?int $ratingVersionsOriginal): self
    {
        $this->rating_versions_original = $ratingVersionsOriginal;
        return $this;
    }

    public function setRatingVersionsAlternative(?int $ratingVersionsAlternative): self
    {
        $this->rating_versions_alternative = $ratingVersionsAlternative;
        return $this;
    }

    public function setGoalsPrevented(mixed $goalsPrevented): self
    {
        $this->goals_prevented = $goalsPrevented;
        return $this;
    }

    public function setAerialLost(?int $aerialLost): self
    {
        $this->aerial_lost = $aerialLost;
        return $this;
    }

    public function setAerialWon(?int $aerialWon): self
    {
        $this->aerial_won = $aerialWon;
        return $this;
    }

    public function setDuelLost(?int $duelLost): self
    {
        $this->duel_lost = $duelLost;
        return $this;
    }

    public function setDuelWon(?int $duelWon): self
    {
        $this->duel_won = $duelWon;
        return $this;
    }

    public function setDispossessed(?int $dispossessed): self
    {
        $this->dispossessed = $dispossessed;
        return $this;
    }

    public function setTotalContest(?int $totalContest): self
    {
        $this->total_contest = $totalContest;
        return $this;
    }

    public function setBigChanceCreated(?int $bigChanceCreated): self
    {
        $this->big_chance_created = $bigChanceCreated;
        return $this;
    }

    public function setBigChanceMissed(?int $bigChanceMissed): self
    {
        $this->big_chance_missed = $bigChanceMissed;
        return $this;
    }

    public function setShotOffTarget(?int $shotOffTarget): self
    {
        $this->shot_off_target = $shotOffTarget;
        return $this;
    }

    public function setOnTargetScoringAttempt(?int $onTargetScoringAttempt): self
    {
        $this->on_target_scoring_attempt = $onTargetScoringAttempt;
        return $this;
    }

    public function setHitWoodwork(?int $hitWoodwork): self
    {
        $this->hit_woodwork = $hitWoodwork;
        return $this;
    }

    public function setGoals(?int $goals): self
    {
        $this->goals = $goals;
        return $this;
    }

    public function setTotalTackle(?int $totalTackle): self
    {
        $this->total_tackle = $totalTackle;
        return $this;
    }

    public function setWasFouled(?int $wasFouled): self
    {
        $this->was_fouled = $wasFouled;
        return $this;
    }

    public function setFouls(?int $fouls): self
    {
        $this->fouls = $fouls;
        return $this;
    }

    public function setTotalOffside(?int $totalOffside): self
    {
        $this->total_offside = $totalOffside;
        return $this;
    }

    public function setMinutesPlayed(?int $minutesPlayed): self
    {
        $this->minutes_played = $minutesPlayed;
        return $this;
    }

    public function setExpectedGoals(mixed $expectedGoals): self
    {
        $this->expected_goals = $expectedGoals;
        return $this;
    }

    public function setKeyPass(?int $keyPass): self
    {
        $this->key_pass = $keyPass;
        return $this;
    }

    public function setPenaltyMiss(?int $penaltyMiss): self
    {
        $this->penalty_miss = $penaltyMiss;
        return $this;
    }

    public function setExpectedAssists(mixed $expectedAssists): self
    {
        $this->expected_assists = $expectedAssists;
        return $this;
    }
}
