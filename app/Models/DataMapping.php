<?php

namespace App\Models;

/**
 * @property int $id
 * @property int $source_id
 * @property int $tipster_table_id
 * @property string $table_name
 */
class DataMapping extends BaseModel
{
    protected $fillable = [
        'source_id',
        'tipster_table_id',
        'table_name',
    ];
}
