<?php

namespace App\Models\Tipster;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 * @property int $category_id
 * @property CategoryTipster $category
 */
class TournamentTipster extends Model
{
    protected $table = 'tournaments_tipsters';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategoryTipster::class, 'category_id');
    }

    public function seasons(): HasMany
    {
        return $this->hasMany(TournamentSeasonsTipster::class, 'tournament_id');
    }
}
