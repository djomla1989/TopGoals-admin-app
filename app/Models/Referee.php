<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $source_id
 * @property string $name
 * @property string $country_code
 * @property bool $is_active
 */
class Referee extends BaseModel
{
    protected $table = 'referees';

    protected $fillable = [
        'source_id',
        'name',
        'country_code',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
