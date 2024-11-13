<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property string year
 * @property string slug
 * @property string description
 * @property string image
 * @property int tournament_id
 * @property int import_id
 */
class TournamentSeason extends Model
{
    protected $fillable = [
        'name',
        'year',
        'slug',
        'tournament_id',
        'description',
        'image',
    ];
    //

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }
}
