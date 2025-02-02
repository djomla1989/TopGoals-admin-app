<?php

namespace App\Builder\Team;

use App\Enums\Gender;
use App\Models\BaseModelInterface;
use App\Models\Sport;
use App\Models\Team;
use App\Utils\DateTimeHelper;
use Carbon\Carbon;

class TeamBuilder
{
    public static function build(array $data, Sport $sport): Team
    {
        /** @var Team $team */
        $team = Team::firstOrNew(
            [
                'source_id' => $data['id']
            ]
        );
        $team->setSourceId($data['id']);
        $team->name = $data['name'];
        $team->slug = $data['slug'];
        $team->name_translation = $data['fieldTranslations']['nameTranslation'] ?? [];
        $team->name_code = $data['nameCode'] ?? null;
        $team->is_national = $data['national'] ?? false;
        $team->gender = Gender::resolveGender($data['gender'] ?? '', $data['name'])->value;
        $team->setSport($sport);

        if (isset($data['foundationDateTimestamp'] )) {
            $foundationDate = new \DateTime();
            $foundationDate->setTimestamp($data['foundationDateTimestamp']);
            $team->setFoundationDate($foundationDate);
        }

        $team->setCountryCode($data['country']['alpha2'] ?? '');

        return $team;
    }
}
