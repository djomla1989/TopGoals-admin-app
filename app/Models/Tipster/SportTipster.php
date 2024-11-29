<?php

namespace App\Models\Tipster;

use App\Models\BaseModel;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 */
class SportTipster extends BaseModel
{
    protected $table = 'sports_tipsters';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'created_at',
        'updated_at',
    ];
}
