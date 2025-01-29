<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class SeasonRound
 * @package App\Models
 *
 * @property int $id
 * @property int $source_id
 * @property int $season_id
 * @property string $name
 * @property string $slug
 * @property int $round_number
 * @property string $last_sync
 * @property Season $season
 */
class SeasonRound extends BaseModel implements SourceIdInterface
{
    protected $table = 'season_rounds';

    protected $fillable = [
        'source_id',
        'season_id',
        'name',
        'slug',
        'round_number',
        'last_sync',
    ];

    public function getSourceId(): int
    {
        return $this->source_id;
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
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

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function setRoundNumber(int $roundNumber): self
    {
        $this->round_number = $roundNumber;
        return $this;
    }

    public function setLastSync(\DateTime $lastSync): self
    {
        $this->last_sync = $lastSync;

        return $this;
    }
}
