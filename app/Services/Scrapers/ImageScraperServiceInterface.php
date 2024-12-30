<?php

namespace App\Services\Scrapers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;
use Symfony\Component\DomCrawler\Crawler;

interface ImageScraperServiceInterface
{
    public function getImageSrc(string $url, string $imgSelector): ?string;
}
