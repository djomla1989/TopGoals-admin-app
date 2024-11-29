<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string import_id
 * @property string name
 * @property string short_name
 * @property string code
 * @property string slug
 * @property int sport_id
 * @property int category_id
 * @property int primary_tournament_id
 * @property bool is_national
 * @property string gender
 * @property string image
 * @property string primary_color
 */
class Team extends BaseModel
{
    protected $fillable = [
        'import_id',
        'name',
        'short_name',
        'code',
        'slug',
        'sport_id',
        'category_id',
        'primary_tournament_id',
        'is_national',
        'gender',
        'primary_color',
        'image',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function primaryTournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class, 'primary_tournament_id');
    }
}
