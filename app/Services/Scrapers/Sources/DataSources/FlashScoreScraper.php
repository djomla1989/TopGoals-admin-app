<?php

namespace App\Services\Scrapers\Sources\DataSources;

use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class FlashScoreScraper extends AbstractDataScraper implements DataScraperInterface
{

    public function fetchTournamentList(string $url): array
    {
        return [];
    }

    public function fetchTournamentData(string $url): array
    {
        return [];
    }

    public function fetchSportList(string $url): array
    {
        return [];
    }

    public function fetchCategoryList(string $url): array
    {
        return [];
    }

    public function fetchTournamentSeasons(string $url): array
    {
        return [];
    }

    public function fetchSeasonsTeams(string $url): array
    {
        return [];
    }

    public function fetchTeamData(string $url): array
    {
        return [];
    }

    public function getSportMap(): array
    {
        return [];
    }

    public function getCategoryMap(): array
    {
        return [];
    }

    public function getTournamentMap(): array
    {
        return [];
    }

    public function getSeasonMap(): array
    {
        return [];
    }

    public function getTeamMap(): array
    {
        return [];
    }
}
