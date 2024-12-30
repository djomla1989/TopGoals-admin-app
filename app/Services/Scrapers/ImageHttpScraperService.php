<?php

namespace App\Services\Scrapers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

class ImageHttpScraperService implements ImageScraperServiceInterface
{

    public function getImageSrc(string $url, string $imgSelector): ?string
    {
        try {
            $response = Http::get($url);

            $html = (string) $response->getBody();

            $crawler = new Crawler($html);

            $image = $crawler->filter($imgSelector);

            if ($image->count() === 0) {
                return null;
            }

            return $image->attr('src');
        } catch (\Exception $e) {
            Log::error('Failed to fetch image src :: '.__FILE__,
                [
                    'url' => $url,
                    'imgSelector' => $imgSelector,
                    'error' => $e->getMessage()
                ]);
            return null;
        }
    }
}
