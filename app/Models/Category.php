<?php

namespace App\Models;

/**
 * @property int import_id
 * @property string name
 * @property string code
 * @property string slug
 * @property int priority
 * @property string image
 */
class Category extends BaseModel
{
    protected $fillable = [
        'import_id',
        'name',
        'code',
        'slug',
        'priority',
        'image',
    ];
}
