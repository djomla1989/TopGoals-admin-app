<?php

namespace App\Models\AllSports;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int import_id
 * @property string name
 * @property string slug
 * @property string group_name
 * @property int tournament_id
 * @property int tournament_season_id
 * @property bool is_group
 * @property int priority
 * @property TournamentAllSports tournament
 * @property TournamentSeasonAllSports tournamentSeason
 */
class TournamentSeasonGroupAllSports extends BaseModel
{
    protected $table = 'tournament_season_groups_allsports';

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
        return $this->belongsTo(TournamentAllSports::class);
    }

    public function tournamentSeason(): BelongsTo
    {
        return $this->belongsTo(TournamentSeasonAllSports::class);
    }
}
