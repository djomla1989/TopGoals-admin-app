<?php

namespace App\Models\SportRadar;

use App\Models\OsSport\CategoryOsSport;
use App\Models\Tipster\CategoryTipster;
use App\Models\Tipster\TournamentSeasonsTipster;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 * @property int $category_id
 * @property CategorySportRadar $category
 */
class TournamentSportRadar extends Model
{
    protected $table = 'tournaments_sportradar';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'category_id',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(CategorySportRadar::class, 'category_id');
    }
}
