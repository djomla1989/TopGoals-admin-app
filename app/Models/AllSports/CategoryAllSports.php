<?php

namespace App\Models\AllSports;

use App\Models\BaseModel;

/**
 * @property int import_id
 * @property string name
 * @property string code
 * @property string slug
 * @property int priority
 * @property string image
 */
class CategoryAllSports extends BaseModel
{
    protected $table = 'categories_allsports';

    protected $fillable = [
        'import_id',
        'name',
        'code',
        'slug',
        'priority',
        'image',
    ];
}
