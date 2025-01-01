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
        'ossport_table_id',
        'allsport_table_id',
        'sportradar_table_id',
        'oddsfeed_table_id',
        'table_name',
    ];
}
