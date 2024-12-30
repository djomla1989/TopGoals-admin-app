<?php

namespace App\Services\Scrapers\Sources\DataSources;

interface DataScraperInterface
{
    public function fetchSportList(string $url): array;

    public function getSportMap(): array;

    public function fetchCategoryList(string $url): array;

    public function getCategoryMap(): array;

    public function fetchTournamentList(string $url): array;

    public function fetchTournamentData(string $url): array;

    public function getTournamentMap(): array;

    public function fetchTournamentSeasons(string $url): array;

    public function getSeasonMap(): array;

    public function fetchSeasonsTeams(string $url): array;

    public function fetchTeamData(string $url): array;

    public function getTeamMap(): array;
}
