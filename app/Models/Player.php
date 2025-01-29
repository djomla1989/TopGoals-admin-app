<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_id
 * @property int $sport_id
 * @property string $name
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string $slug
 * @property string|null $country_code
 * @property string|null $position
 * @property string $gender
 * @property int|null $height
 * @property int|null $weight
 * @property \DateTime|null $date_of_birth
 * @property int|null $jersey_number
 * @property bool $is_active
 * @property \DateTime|null $last_sync
 */
class Player extends BaseModel
{
    protected $fillable = [
        'source_id',
        'sport_id',
        'name',
        'first_name',
        'last_name',
        'slug',
        'country_code',
        'position',
        'gender',
        'height',
        'weight',
        'date_of_birth',
        'jersey_number',
        'is_active',
        'last_sync',
    ];

    protected $casts = [
        'date_of_birth' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;

        return $this;
    }

    public function setSport(Sport $sport): self
    {
        $this->sport()->associate($sport);

        return $this;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function setFirstName(string $firstName): self
    {
        $this->first_name = $firstName;

        return $this;
    }

    public function setLastName(string $lastName): self
    {
        $this->last_name = $lastName;

        return $this;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setGender(string $gender): self
    {
        $this->gender = $gender;

        return $this;
    }

    public function setDateOfBirth(\DateTime $dateOfBirth): self
    {
        $this->date_of_birth = $dateOfBirth;

        return $this;
    }

    public function setJerseyNumber(int $jerseyNumber): self
    {
        $this->jersey_number = $jerseyNumber;

        return $this;
    }

    public function setIsActive(bool $isActive): self
    {
        $this->is_active = $isActive;

        return $this;
    }

    public function setLastSync(\DateTime $lastSync): self
    {
        $this->last_sync = $lastSync;

        return $this;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;

        return $this;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    public function setWeight(?int $weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->country_code = $countryCode;

        return $this;
    }

    public function getPosition(): ?string
    {
        return $this->position;
    }
}
