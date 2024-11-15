<?php

namespace App\Enums;

enum Gender: string
{
    case Male = 'M';
    case Female = 'F';
    case Mixed = 'MIX';

    public static function resolveGender(string $gender, string $fallback): Gender
    {
        return match ($gender) {
            self::Male->value => self::Male,
            self::Female->value => self::Female,
            self::Mixed->value => self::Mixed,
            default => self::resolveGenderByString($fallback),
        };
    }

    public static function resolveGenderByString(string $name): Gender
    {
        $name = strtolower($name);
        if (str_contains($name, 'woman') || str_contains($name, 'women') || str_contains($name, 'female')) {
            return self::Female;
        }

        return self::Male;
    }

    public function label(): string
    {
        return match ($this) {
            self::Male => 'Male',
            self::Female => 'Female',
            self::Mixed => 'Mixed',
        };
    }
}
