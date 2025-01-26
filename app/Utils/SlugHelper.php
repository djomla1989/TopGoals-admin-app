<?php

namespace App\Utils;

use Illuminate\Support\Str;

class SlugHelper
{
    public static function generateSlug(string $string): string
    {
        return Str::slug($string);
    }
}
