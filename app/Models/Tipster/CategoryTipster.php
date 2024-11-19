<?php

namespace App\Models\Tipster;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $import_id
 * @property string $name
 * @property string $slug
 * @property string $code
 */
class CategoryTipster extends BaseModel
{
    protected $table = 'categories_tipsters';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'code',
    ];
}
