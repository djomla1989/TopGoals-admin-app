<?php

namespace App\Models\SportRadar;

use App\Models\BaseModel;
use App\Models\OsSport\TournamentOsSport;
use App\Models\Tipster\TournamentTipster;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 * @property string $code
 * @property TournamentOsSport[] $tournaments
 */
class CategorySportRadar extends BaseModel
{
    protected $table = 'categories_sportradar';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'code',
    ];

    public function tournaments(): HasMany
    {
        return $this->hasMany(TournamentTipster::class, 'category_id');
    }
}
