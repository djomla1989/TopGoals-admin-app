<?php

namespace App\Models;

/**
 * @property string name
 * @property string description
 * @property string image
 */
class Sport extends BaseModel
{
    const FOOTBALL = 'Football';

    protected $fillable = [
        'name',
        'description',
        'image',
    ];
}
