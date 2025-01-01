<?php

namespace App\Models\OsSport;

use App\Models\BaseModel;
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
class CategoryOsSport extends BaseModel
{
    protected $table = 'categories_ossport';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'code',
    ];

    public function tournaments(): HasMany
    {
        return $this->hasMany(TournamentOsSport::class, 'category_id');
    }
}
