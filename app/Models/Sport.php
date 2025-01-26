<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $source_id
 * @property string $name
 * @property string $slug
 * @property bool $is_active
 * @property int $order
 */
class Sport extends BaseModel
{
    protected $table = 'sports';

    protected $fillable = [
        'source_id',
        'name',
        'slug',
        'is_active',
        'order',
    ];

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, 'sport_id');
    }
}
