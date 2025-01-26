<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @property int id
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @mixin Model
 * @mixin Builder
 * @mixin QueryBuilde
 */
class BaseModel extends Model implements BaseModelInterface
{
    public function getId(): int
    {
        return $this->id;
    }
}
