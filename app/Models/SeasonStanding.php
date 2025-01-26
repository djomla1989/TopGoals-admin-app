<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class SeasonStanding
 * @package App\Models
 *
 * @property int $id
 * @property int $season_id
 * @property string $type
 * @property Season $season
 */
class SeasonStanding extends BaseModel
{
    protected $table = 'season_standings';

    protected $fillable = [
        'season_id',
        'type'
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(SeasonStandingGroup::class);
    }

    public function setSeason(Season $season): self
    {
        $this->season()->associate($season);
        return $this;
    }

    public function setType(mixed $type): self
    {
        $this->type = $type;
        return $this;
    }
}
