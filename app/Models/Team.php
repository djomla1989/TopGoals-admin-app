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
 * @property string $country_code
 * @property bool $is_national
 * @property string $gender
 * @property int $manager_id
 * @property int $venue_id
 * @property bool $is_active
 * @property ?\DateTime $foundation_date
 * @property ?\DateTime $last_sync
 * @property Sport $sport
 * @property Player $manager
 * @property Venue $venue
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
        'country_code',
        'is_national',
        'gender',
        'manager_id',
        'venue_id',
        'is_active',
        'foundation_date',
        'last_sync',
    ];

    protected $casts = [
        'is_national' => 'boolean',
        'is_active' => 'boolean',
        'foundation_date' => 'datetime',
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

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }


    public function setSport(Sport $sport): self
    {
        $this->sport()->associate($sport);
        return $this;
    }

    public function setVenue(Venue $venue): self
    {
        $this->venue()->associate($venue);
        return $this;
    }

    public function setManager(Player $manager): self
    {
        $this->manager()->associate($manager);
        return $this;
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;
        return $this;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->is_active = $isActive;
        return $this;
    }

    public function setLastSync(?\DateTime $lastSync): self
    {
        $this->last_sync = $lastSync;
        return $this;
    }

    public function setFoundationDate(?\DateTime $foundationDate): self
    {
        $this->foundation_date = $foundationDate;
        return $this;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->country_code = $countryCode;
        return $this;
    }
}
