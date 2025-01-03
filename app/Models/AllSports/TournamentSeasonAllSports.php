<?php

namespace App\Models\AllSports;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property string name
 * @property int import_id
 * @property string year
 * @property string slug
 * @property string image
 * @property int tournament_id
 * @property TournamentAllSports tournament
 * @property int category_id
 * @property int sport_id
 * @property SportAllSports sport
 * @property CategoryAllSports category
 */
class TournamentSeasonAllSports extends BaseModel
{
    protected $table = 'tournament_seasons_allsports';

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
        return $this->belongsTo(TournamentAllSports::class);
    }

    public function sport(): BelongsTo
    {
        return $this->belongsTo(SportAllSports::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryAllSports::class);
    }
}
