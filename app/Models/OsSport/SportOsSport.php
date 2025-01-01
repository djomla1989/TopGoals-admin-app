<?php

namespace App\Models\OsSport;

use App\Models\BaseModel;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 */
class SportOsSport extends BaseModel
{
    protected $table = 'sports_ossport';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];
}
