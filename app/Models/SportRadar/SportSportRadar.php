<?php

namespace App\Models\SportRadar;

use App\Models\BaseModel;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 */
class SportSportRadar extends BaseModel
{
    protected $table = 'sports_sportradar';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];
}
