<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * @property int id
 * @property string name
 * @property string short_name
 * @property string code
 * @property string slug
 * @property string import_id
 * @property int sport_id
 * @property int country_id
 * @property int primary_tournament_id
 * @property bool is_national
 * @property string gender
 * @property string image
 * @property string primary_color
 */
class Team extends Model
{
    protected $fillable = [
        'name',
        'short_name',
        'code',
        'slug',
        'import_id',
        'sport_id',
        'country_id',
        'primary_tournament_id',
        'is_national',
        'gender',
        'primary_color',
        'image'
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function primaryTournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class, 'primary_tournament_id');
    }

}
