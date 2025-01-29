<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SeasonRoundTeamOfTheWeek
 * @package App\Models
 *
 * @property int $id
 * @property int $season_round_id
 * @property string $formation
 * @property SeasonRound $seasonRound
 */
class SeasonRoundTeamOfTheWeek extends BaseModel
{
    protected $table = 'season_round_team_of_the_weeks';

    protected $fillable = [
        'season_round_id',
        'formation'
    ];

    public function seasonRound(): BelongsTo
    {
        return $this->belongsTo(SeasonRound::class);
    }

    public function setSeasonRound(SeasonRound $seasonRound): self
    {
        $this->seasonRound()->associate($seasonRound);
        return $this;
    }

    public function setFormation(string $formation): self
    {
        $this->formation = $formation;
        return $this;
    }
}
