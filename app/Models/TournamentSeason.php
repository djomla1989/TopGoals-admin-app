<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property int import_id
 * @property string year
 * @property string slug
 * @property string image
 * @property int tournament_id
 * @property Tournament tournament
 * @property int category_id
 * @property int sport_id
 * @property Sport sport
 * @property Category category
 */
class TournamentSeason extends BaseModel
{
    protected $fillable = [
        'name',
        'import_id',
        'year',
        'slug',
        'tournament_id',
        'image',
    ];
    //

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
