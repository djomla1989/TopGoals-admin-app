<?php

namespace App\Services\Scrapers\Sources\DTO;

class SportDTO implements DataDTOInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $slug,
        public string $url,
        public ?string $iconUrl = null,
    ) {
    }
}
