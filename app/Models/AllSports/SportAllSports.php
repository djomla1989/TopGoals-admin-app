<?php

namespace App\Models\AllSports;

use App\Models\BaseModel;

class SportAllSports extends BaseModel
{
    protected $table = 'sports_allsports';

    const FOOTBALL = 'Football';

    protected $fillable = [
        'import_id',
        'name',
        'slug',
        'image',
    ];
}
