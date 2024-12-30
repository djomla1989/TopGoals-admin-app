<?php

namespace App\Services\Scrapers\Sources\DTO;

class TeamDTO implements DataDTOInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $sport,
        public string $category,
        public string $countryCode,
        public string $slug,
        public string $gender,
        public string $type,
        public string $url,
        public ?string $iconUrl = null,
    ) {
    }
}
