<?php

namespace App\Services\Scrapers\Sources\DTO;

class CategoryDTO implements DataDTOInterface
{
    public function __construct(
        public string $id,
        public string $name,
        public string $sport,
        public string $slug,
        public string $url,
        public ?string $countryCode = null,
        public ?string $iconUrl = null,
    ) {
    }

}
