<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Translatable\HasTranslations;

/**
 * @property int $id
 * @property int $source_id
 * @property string $name
 * @property array|null $name_translation
 * @property string $slug
 * @property string $city
 * @property string|null $country_code
 * @property string|null $address
 * @property int|null $capacity
 * @property float|null $latitude
 * @property float|null $longitude
 * @property bool $is_active
 */
class Venue extends BaseModel
{

    use HasTranslations;

    protected $fillable = [
        'source_id',
        'name',
        'name_translation',
        'slug',
        'city',
        'country_code',
        'address',
        'latitude',
        'longitude',
        'capacity',
        'is_active',
    ];

    public $translatable = ['name_translation'];

    protected $casts = [
        'name_translation' => 'array',
        'is_active' => 'boolean',
    ];

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

    public function setNameTranslation(array $nameTranslation): self
    {
        $this->name_translation = $nameTranslation;

        return $this;
    }


    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function setCountryCode(?string $countryCode): self
    {
        $this->country_code = $countryCode;

        return $this;
    }

    public function setAddress(?string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function setLatitude(?float $latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function setLongitude(?float $longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function setCapacity(?int $capacity): self
    {
        $this->capacity = $capacity;

        return $this;
    }
}
