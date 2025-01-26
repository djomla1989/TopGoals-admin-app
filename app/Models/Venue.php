<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_id
 * @property int $sport_id
 * @property string $name
 * @property array|null $name_translation
 * @property string $slug
 * @property string $city
 * @property string|null $country_code
 * @property string|null $address
 * @property int|null $capacity
 * @property bool $is_active
 * @property Sport $sport
 */
class Venue extends BaseModel
{
    protected $fillable = [
        'source_id',
        'sport_id',
        'name',
        'name_translation',
        'slug',
        'city',
        'country_code',
        'address',
        'capacity',
        'is_active',
    ];

    protected $casts = [
        'name_translation' => 'array',
        'is_active' => 'boolean',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }
}
