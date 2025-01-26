<?php

namespace App\Builder\Team;

use App\Enums\Gender;
use App\Models\BaseModelInterface;
use App\Models\Sport;
use App\Models\Team;

class TeamBuilder
{
    public static function build(array $data, Sport $sport): Team
    {
        $team = Team::firstOrNew(['source_id' => $data['id']]);
        $team->name = $data['name'];
        $team->slug = $data['slug'];
        $team->name_translation = $data['fieldTranslations']['nameTranslation'] ?? [];
        $team->name_code = $data['nameCode'] ?? null;
        $team->is_national = $data['national'] ?? false;
        $team->gender = Gender::resolveGender($data['gender'] ?? '', $data['name'])->value;
        $team->setSport($sport);

        return $team;
    }
}
