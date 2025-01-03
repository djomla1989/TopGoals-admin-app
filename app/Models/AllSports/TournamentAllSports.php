<?php

namespace App\Models\AllSports;

use App\Models\BaseModel;
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
class TournamentAllSports extends BaseModel
{
    protected $table = 'tournaments_allsports';

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
        return $this->belongsTo(SportAllSports::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryAllSports::class);
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(TournamentSeasonAllSports::class);
    }
}
