<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int import_id
 * @property string name
 * @property string slug
 * @property string group_name
 * @property int tournament_id
 * @property int tournament_season_id
 * @property boolean is_group
 * @property int priority
 */
class TournamentSeasonGroup extends BaseModel
{
    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'group_name',
        'tournament_id',
        'tournament_season_id',
        'is_group',
        'priority',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function tournamentSeason(): BelongsTo
    {
        return $this->belongsTo(TournamentSeason::class);
    }
}
