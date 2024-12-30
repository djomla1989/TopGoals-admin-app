<?php

namespace App\Models\Tipster;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 * @property int $year
 * @property int $tournament_id
 * @property TournamentTipster $tournament
 */
class TournamentSeasonsTipster extends Model
{
    protected $table = 'tournament_seasons_tipsters';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'year',
        'tournament_id',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(TournamentTipster::class, 'tournament_id');
    }
}
