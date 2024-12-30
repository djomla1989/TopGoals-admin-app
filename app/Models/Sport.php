<?php

namespace App\Models;

class Sport extends BaseModel
{
    const FOOTBALL = 'Football';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'image',
    ];
}
