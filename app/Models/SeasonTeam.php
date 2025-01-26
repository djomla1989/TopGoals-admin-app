<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SeasonTeam
 * @package App\Models
 *
 * @property int $id
 * @property int $tournament_id
 * @property int $season_id
 * @property int $team_id
 * @property bool $newcomer_upper
 * @property bool $newcomer_lower
 * @property Tournament $tournament
 * @property Season $season
 * @property Team $team
 */
class SeasonTeam extends BaseModel
{
    protected $table = 'season_teams';

    protected $fillable = [
        'tournament_id',
        'season_id',
        'team_id',
        'newcomer_upper',
        'newcomer_lower',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function setTournament(Tournament $tournament): self
    {
        $this->tournament()->associate($tournament);
        return $this;
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

    public function setNewcomerUpper(bool $newcomerUpper): self
    {
        $this->newcomer_upper = $newcomerUpper;
        return $this;
    }

    public function setNewcomerLower(bool $newcomerLower): self
    {
        $this->newcomer_lower = $newcomerLower;
        return $this;
    }

}
