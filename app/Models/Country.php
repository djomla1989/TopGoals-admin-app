<?php

namespace App\Models;
/**
 * @property string name
 * @property string code
 * @property string description
 * @property string image
 */
class Country extends BaseModel
{
    protected $fillable = [
        'name',
        'code',
        'description',
        'image',
    ];
}
