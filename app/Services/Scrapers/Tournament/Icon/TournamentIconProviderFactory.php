<?php

namespace App\Services\Scrapers\Tournament\Icon;

use App\Models\AllSports\TournamentAllSports;
use App\Services\Scrapers\Exceptions\TournamentIconSportNotSupportedException;
use App\Services\Scrapers\ImageScraperServiceInterface;
use App\Services\Scrapers\Tournament\Icon\Providers\FlashScoreTournamentIconProvider;
use App\Services\Scrapers\Tournament\Icon\Providers\XScoreTournamentIconProvider;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Facades\Log;

class TournamentIconProviderFactory implements TournamentIconProviderFactoryInterface
{
    private HttpClient $httpClient;

    private ImageScraperServiceInterface $imageScraperService;

    public function __construct(
        HttpClient $httpClient,
        ImageScraperServiceInterface $imageScraperService
    )
    {
        $this->httpClient = $httpClient;
        $this->imageScraperService = $imageScraperService;
    }

    public function getProviders(TournamentAllSports $tournament): array
    {
        try {
            $sport = $tournament->sport->id;

            return match ($sport) {
                'soccer', 'basketball', 'volleyball', 'hockey', 'tennis' => [
                    new XScoreTournamentIconProvider($this->httpClient),
                    new FlashScoreTournamentIconProvider($this->imageScraperService),
                ],
                default => throw new TournamentIconSportNotSupportedException(sprintf('Sport %s is not supported', $sport)),
            };
        } catch (\Exception $e) {
            Log::error('ERROR::TournamentIconFetcherFactory: ' . $e->getMessage());
            return [];
        }
    }

}
