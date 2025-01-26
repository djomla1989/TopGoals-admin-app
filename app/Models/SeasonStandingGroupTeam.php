<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SeasonStandingGroupTeam
 * @package App\Models
 *
 * @property int $id
 * @property int source_id
 * @property int $season_standing_group_id
 * @property int $team_id
 * @property int $position
 * @property int $points
 * @property int $matches
 * @property int $wins
 * @property int $draws
 * @property int $losses
 * @property int $scores_for
 * @property int $scores_against
 * @property int $scores_difference
 * @property string $promotion
 * @property SeasonStandingGroup $seasonStandingGroup
 * @property Team $team
 */
class SeasonStandingGroupTeam extends Model
{
    protected $table = 'season_standing_group_teams';

    protected $fillable = [
        'source_id',
        'season_standing_group_id',
        'team_id',
        'position',
        'points',
        'matches',
        'wins',
        'draws',
        'losses',
        'scores_for',
        'scores_against',
        'scores_difference',
        'promotion',
    ];

    public function seasonStandingGroup(): BelongsTo
    {
        return $this->belongsTo(SeasonStandingGroup::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function setSeasonStandingGroup(SeasonStandingGroup $seasonStandingGroup): self
    {
        $this->seasonStandingGroup()->associate($seasonStandingGroup);
        return $this;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;
        return $this;
    }

    public function setTeam(Team $team): self
    {
        $this->team()->associate($team);
        return $this;
    }

    public function setPosition(?int $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function setPoints(?int $points): self
    {
        $this->points = $points;
        return $this;
    }

    public function setMatches(?int $matches): self
    {
        $this->matches = $matches;
        return $this;
    }

    public function setWins(?int $wins): self
    {
        $this->wins = $wins;
        return $this;
    }

    public function setDraws(?int $draws): self
    {
        $this->draws = $draws;
        return $this;
    }

    public function setLosses(?int $losses): self
    {
        $this->losses = $losses;
        return $this;
    }

    public function setScoresFor(?int $scoresFor): self
    {
        $this->scores_for = $scoresFor;
        return $this;
    }

    public function setScoresAgainst(?int $scoresAgainst): self
    {
        $this->scores_against = $scoresAgainst;
        return $this;
    }

    public function setGoalDifference(?int $goalDifference): self
    {
        $this->scores_difference = $goalDifference;
        return $this;
    }

    public function setPromotion(?string $promotion): self
    {
        $this->promotion = $promotion;
        return $this;
    }
}
