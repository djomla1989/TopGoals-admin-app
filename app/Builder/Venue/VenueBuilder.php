<?php

namespace App\Builder\Venue;

use App\Models\Venue;

class VenueBuilder
{
    public static function build(array $data): Venue
    {
        /**
         * @var Venue $venue
         */
        $venue = Venue::firstOrNew(
            [
                'source_id' => $data['id']
            ]
        );

        $venue->setSourceId($data['id']);
        $venue->setName($data['name']);
        $venue->setSlug($data['slug']);
        $venue->setNameTranslation($data['fieldTranslations']['nameTranslation'] ?? []);
        $venue->setNameCode($data['nameCode'] ?? null);
        $venue->setCity($data['city']['name'] ?? null);
        $venue->setCountryCode($data['country']['alpha2'] ?? null);
        $venue->setAddress($data['address'] ?? null);
        $venue->setLatitude($data['venueCoordinates']['latitude'] ?? null);
        $venue->setLongitude($data['venueCoordinates']['longitude'] ?? null);
        $venue->setCapacity($data['capacity'] ?? null);

        return $venue;
    }
}
