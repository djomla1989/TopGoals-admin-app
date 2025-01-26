<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $source_id
 * @property int $tournament_id
 * @property string $name
 * @property string $name_translation
 * @property string $slug
 * @property bool $is_active
 * @property string $year
 * @property string $start_date
 * @property string $end_date
 * @property string $last_sync
 * @property Tournament $tournament
 */
class Season extends BaseModel
{
    use HasTranslations;

    protected $table = 'seasons';

    public $translatable = ['name_translation'];

    protected $fillable = [
        'source_id',
        'tournament_id',
        'name',
        'name_translation',
        'slug',
        'is_active',
        'year',
        'start_date',
        'end_date',
        'last_sync',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'last_sync' => 'datetime',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class, 'tournament_id');
    }

    public function setSourceId(mixed $id): self
    {
        $this->source_id = $id;
        return $this;
    }

    public function setName(mixed $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setTournamentId(int $id): self
    {
        $this->tournament_id = $id;
        return $this;
    }

    public function setYear(mixed $year): self
    {
        $this->year = $year;
        return $this;
    }

    public function setSlug(string $generateSlug): self
    {
        $this->slug = $generateSlug;
        return $this;
    }

    public function setLastSync(\DateTime $now): self
    {
        $this->last_sync = $now;
        return $this;
    }

    public function setNameTranslation(mixed $name): self
    {
        $this->name_translation = $name;
        return $this;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function getLastSync(): ? \DateTime
    {
        return $this->last_sync;
    }

    public function getSourceId(): int
    {
        return $this->source_id;
    }

}
