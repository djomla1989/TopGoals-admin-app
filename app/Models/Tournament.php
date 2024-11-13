<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string name
 * @property int import_id
 * @property string gender
 * @property string slug
 * @property string description
 * @property int sport_id
 * @property int country_id
 * @property string image
 * @property string type
 */
class Tournament extends BaseModel
{
    protected $fillable = [
        'name',
        'slug',
        'sport_id',
        'country_id',
        'description',
        'image',
        'gender',
        'type'
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(TournamentSeason::class);
    }
}
