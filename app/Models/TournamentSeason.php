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
 * @property Tournament tournament
 * @property int import_id
 * @property Sport sport
 * @property Country country
 */
class TournamentSeason extends BaseModel
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
