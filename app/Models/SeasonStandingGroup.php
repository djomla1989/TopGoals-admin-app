<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class SeasonStandingGroup
 * @package App\Models
 *
 * @property int $id
 * @property int $source_id
 * @property int $season_standing_id
 * @property string $name
 * @property string $tie_breaking_rule
 * @property SeasonStanding $seasonStanding
 */
class SeasonStandingGroup extends BaseModel
{
    protected $table = 'season_standing_groups';

    protected $fillable = [
        'source_id',
        'season_standing_id',
        'name',
        'tie_breaking_rule',
    ];

    public function seasonStanding(): BelongsTo
    {
        return $this->belongsTo(SeasonStanding::class);
    }

    public function seasonStandingGroupTeams(): HasMany
    {
        return $this->hasMany(SeasonStandingGroupTeam::class);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setSeasonStanding(SeasonStanding $seasonStanding): self
    {
        $this->seasonStanding()->associate($seasonStanding);
        return $this;
    }

    public function setTieBreakingRule(string $tieBreakingRule): self
    {
        $this->tie_breaking_rule = $tieBreakingRule;
        return $this;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;
        return $this;
    }

}
