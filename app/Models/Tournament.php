<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_id
 * @property string $name
 * @property string $slug
 * @property int $sport_id
 * @property int $category_id
 * @property string $gender
 * @property int $tier
 * @property bool $is_national
 * @property bool $has_groups
 * @property string $age_group
 * @property string $last_sync
 * @property string $start_date
 * @property string $end_date
 * @property bool $is_active
 * @property Category $category
 * @property Sport $sport
 */
class Tournament extends BaseModel
{
    protected $table = 'tournaments';

    protected $fillable = [
        'source_id',
        'name',
        'slug',
        'sport_id',
        'category_id',
        'gender',
        'tier',
        'is_national',
        'has_groups',
        'age_group',
        'last_sync',
        'start_date',
        'end_date',
        'is_active',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
        'is_national' => 'boolean',
        'has_groups' => 'boolean',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'last_sync' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }

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


    public function setSport(Sport $sport): self
    {
        $this->sport()->associate($sport);
        return $this;
    }

    public function setStartDate(\DateTime $startDate): self
    {
        $this->start_date = $startDate;
        return $this;
    }

    public function setEndDate(\DateTime $endDate): self
    {
        $this->end_date = $endDate;
        return $this;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;
        return $this;
    }

    public function setLastSync(\DateTime $lastSync): self
    {
        $this->last_sync = $lastSync;
        return $this;
    }

    public function setAgeGroup(string $ageGroup): self
    {
        $this->age_group = $ageGroup;
        return $this;
    }

    public function setTier(?int $tier): self
    {
        $this->tier = $tier;
        return $this;
    }

    public function setNational(bool $isNational): self
    {
        $this->is_national = $isNational;
        return $this;
    }

    public function setHasGroups(bool $hasGroups): self
    {
        $this->has_groups = $hasGroups;
        return $this;
    }
}
