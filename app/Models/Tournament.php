<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property int import_id
 * @property string gender
 * @property string slug
 * @property int sport_id
 * @property int category_id
 * @property string image
 * @property string type
 */
class Tournament extends BaseModel
{
    protected $fillable = [
        'name',
        'slug',
        'sport_id',
        'category_id',
        'image',
        'gender',
        'type',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(TournamentSeason::class);
    }
}
