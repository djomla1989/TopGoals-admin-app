<?php

namespace App\Builder;

use App\Models\BaseModelInterface;

interface BuilderInterface
{
    public static function build(array $data): BaseModelInterface;
}
