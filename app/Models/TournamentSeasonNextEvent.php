<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string customId
 * @property string slug
 * @property string import_id
 * @property string home_team_name
 * @property int home_team_id
 * @property string away_team_name
 * @property int away_team_id
 * @property int start_timestamp
 * @property int tournament_season_id
 * @property int tournament_id
 * @property int country_id
 * @property int sport_id
 * @property int round
 * @property string status
 */
class TournamentSeasonNextEvent extends BaseModel
{
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
        'country_id',
        'sport_id',
        'round',
        'status',
    ];
}
