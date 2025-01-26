<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $source_id
 * @property int $sport_id
 * @property string $name
 * @property string $slug
 * @property string $country_code
 * @property bool $is_active
 * @property int $order
 */
class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'source_id',
        'sport_id',
        'name',
        'slug',
        'country_code',
        'is_active',
        'order',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class, 'sport_id');
    }
}
