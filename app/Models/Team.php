<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $source_id
 * @property int $sport_id
 * @property string $name
 * @property array $name_translation
 * @property string $name_code
 * @property string $slug
 * @property bool $is_national
 * @property string $gender
 * @property int $manager_id
 * @property bool $is_active
 * @property ?\DateTime $last_sync
 * @property Sport $sport
 * @property Player $manager
 */
class Team extends BaseModel
{
    use HasTranslations;

    protected $table = 'teams';

    public $translatable = ['name_translation'];

    protected $fillable = [
        'source_id',
        'sport_id',
        'name',
        'name_translation',
        'name_code',
        'slug',
        'is_national',
        'gender',
        'manager_id',
        'is_active',
        'last_sync',
    ];

    protected $casts = [
        'is_national' => 'boolean',
        'is_active' => 'boolean',
        'last_sync' => 'datetime',
    ];

    public function getSourceId(): int
    {
        return $this->source_id;
    }

    public function getIsActive(): bool
    {
        return $this->is_active;
    }

    public function getLastSync(): ?\DateTime
    {
        return $this->last_sync;
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function setSport(Sport $sport): self
    {
        $this->sport()->associate($sport);
        return $this;
    }
}
