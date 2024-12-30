<?php

namespace App\Services\Scrapers\Sources\Services;

use App\Services\Scrapers\Sources\DTO\CategoryDTO;
use App\Services\Scrapers\Sources\DTO\SportDTO;
use App\Services\Scrapers\Sources\DTO\TeamDTO;
use App\Services\Scrapers\Sources\DTO\TournamentDTO;
use App\Services\Scrapers\Sources\DTO\TournamentSeasonDTO;

interface DataScraperServiceInterface
{
    /**
     * @param string $url
     * @return array<SportDTO>
     */
    public function getSports(string $url): array;

    /**
     * @param string $url
     * @return array<CategoryDTO>
     */
    public function getCategories(string $url): array;

    /**
     * @param string $url
     * @return array<TournamentDTO>
     */
    public function getTournaments(string $url): array;

    /**
     * @param string $url
     * @return TournamentDTO
     */
    public function getTournament(string $url): TournamentDTO;

    /**
     * @param string $url
     * @return array<TournamentSeasonDTO>
     */
    public function getTournamentSeasons(string $url): array;

    /**
     * @param string $url
     * @return array<TeamDTO>
     */
    public function getSeasonsTeams(string $url): array;

    /**
     * @param string $url
     * @return TeamDTO
     */
    public function getTeam(string $url): TeamDTO;
}
