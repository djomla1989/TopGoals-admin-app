<?php

namespace App\Services\Scrapers\Team;

use App\Models\Team;
use App\Models\Tournament;
use App\Services\Scrapers\Exceptions\TeamIconSportNotSupportedException;
use App\Services\Scrapers\Exceptions\TournamentIconSportNotSupportedException;
use App\Services\Scrapers\ImageScraperServiceInterface;
use App\Services\Scrapers\Team\Icon\Providers\FlashScoreTeamIconProvider;
use App\Services\Scrapers\Team\Icon\Providers\LiveScoresBizTeamIconProvider;
use App\Services\Scrapers\Team\Icon\Providers\XScoreTeamIconProvider;
use App\Services\Scrapers\Tournament\Icon\Providers\XScoreTournamentIconProvider;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Facades\Log;

class TeamtIconProviderFactory implements TeamtIconProviderFactoryInterface
{
    private HttpClient $httpClient;

    private ImageScraperServiceInterface $imageScraperService;

    public function __construct(HttpClient $httpClient, ImageScraperServiceInterface $imageScraperService)
    {
        $this->httpClient = $httpClient;
        $this->imageScraperService = $imageScraperService;

    }

    public function getProviders(Team $team): array
    {
        try {
            $sport = $team->sport->id;

            return match ($sport) {
                'soccer', 'basketball', 'volleyball', 'hockey' => [
                    new LiveScoresBizTeamIconProvider($this->imageScraperService),
                    new XScoreTeamIconProvider($this->httpClient),
                    new FlashScoreTeamIconProvider($this->imageScraperService),
                ],
                default => throw new TeamIconSportNotSupportedException(sprintf('Sport %s is not supported', $sport)),
            };
        } catch (\Exception $e) {
            Log::error('ERROR::TeamIconFetcherFactory: ' . $e->getMessage());
            return [];
        }
    }

}
