<?php

namespace App\Models;
/**
 * @property string name
 * @property string code
 * @property string description
 * @property string image
 * @property int import_id
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
