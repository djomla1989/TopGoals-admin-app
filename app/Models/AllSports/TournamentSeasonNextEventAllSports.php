<?php

namespace App\Models\AllSports;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int import_id
 * @property string customId
 * @property string slug
 * @property string home_team_name
 * @property int home_team_id
 * @property string away_team_name
 * @property int away_team_id
 * @property int start_timestamp
 * @property int tournament_season_id
 * @property int tournament_id
 * @property int category_id
 * @property int sport_id
 * @property int round
 * @property string status
 * @property TournamentAllSports tournament
 * @property TournamentSeasonAllSports tournamentSeason
 * @property TeamAllSports homeTeam
 * @property TeamAllSports awayTeam
 * @property CategoryAllSports category
 */
class TournamentSeasonNextEventAllSports extends BaseModel
{
    protected $table = 'tournament_season_next_events_allsports';

    protected $fillable = [
        'customId',
        'slug',
        'import_id',
        'home_team_name',
        'home_team_id',
        'away_team_name',
        'away_team_id',
        'start_timestamp',
        'tournament_season_id',
        'tournament_id',
        'category_id',
        'sport_id',
        'round',
        'status',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(TournamentAllSports::class);
    }

    public function tournamentSeason(): BelongsTo
    {
        return $this->belongsTo(TournamentSeasonAllSports::class);
    }

    public function tournamentSeasonGroup(): BelongsTo
    {
        return $this->belongsTo(TournamentSeasonGroupAllSports::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(TeamAllSports::class);
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(TeamAllSports::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryAllSports::class);
    }
}
