<?php

namespace App\Services\Scrapers\Sources\Services;

use App\Services\Scrapers\Sources\DataSources\DataScraperInterface;
use App\Services\Scrapers\Sources\DTO\CategoryDTO;
use App\Services\Scrapers\Sources\DTO\SportDTO;
use App\Services\Scrapers\Sources\DTO\TeamDTO;
use App\Services\Scrapers\Sources\DTO\TournamentDTO;
use App\Services\Scrapers\Sources\DTO\TournamentSeasonDTO;
use App\Services\Scrapers\Sources\Mappers\CategoryDataMapper;
use App\Services\Scrapers\Sources\Mappers\SportDataMapper;
use App\Services\Scrapers\Sources\Mappers\TeamDataMapper;
use App\Services\Scrapers\Sources\Mappers\TournamentDataMapper;
use App\Services\Scrapers\Sources\Mappers\TournamentSeasonDataMapper;

class DataScraperService implements DataScraperServiceInterface
{
    public function __construct(
        protected DataScraperInterface $scraper,
        protected SportDataMapper $sportMapper,
        protected CategoryDataMapper $categoryMapper,
        protected TournamentDataMapper $tournamentMapper,
        protected TournamentSeasonDataMapper $tournamentSeasonMapper,
        protected TeamDataMapper $teamMapper
    ) {
    }

    /**
     * @param string $url
     * @return array<SportDTO>
     */
    public function getSports(string $url): array
    {
        $rawData = $this->scraper->fetchSportList($url);
        $sports = [];
        foreach ($rawData as $item) {
            $sports[] = $this->sportMapper->map($item);
        }
        return $sports;
    }

    /**
     * @param string $url
     * @return array<CategoryDTO>
     */
    public function getCategories(string $url): array
    {
        $rawData = $this->scraper->fetchCategoryList($url);
        $categories = [];
        foreach ($rawData as $item) {
            $categories[] = $this->categoryMapper->map($item);
        }
        return $categories;
    }

    /**
     * @param string $url
     * @return array<TournamentDTO>
     */
    public function getTournaments(string $url): array
    {
        $rawData = $this->scraper->fetchTournamentList($url);
        $tournaments = [];
        foreach ($rawData as $item) {
            $tournaments[] = $this->tournamentMapper->map($item);
        }
        return $tournaments;
    }

    /**
     * @param string $url
     * @return TournamentDTO
     */
    public function getTournament(string $url): TournamentDTO
    {
        $rawData = $this->scraper->fetchTournamentData($url);
        /** @var TournamentDTO $tournament */
        $tournament = $this->tournamentMapper->map($rawData);

        return $tournament;
    }

    /**
     * @param string $url
     * @return array|TournamentSeasonDTO[]
     */
    public function getTournamentSeasons(string $url): array
    {
        $rawData = $this->scraper->fetchTournamentSeasons($url);
        $seasons = [];
        foreach ($rawData as $item) {
            $seasons[] = $this->tournamentSeasonMapper->map($item);
        }
        return $seasons;
    }

    /**
     * @param string $url
     * @return array|TeamDTO[]
     */
    public function getSeasonsTeams(string $url): array
    {
        $rawData = $this->scraper->fetchSeasonsTeams($url);
        $teams = [];
        foreach ($rawData as $item) {
            $teams[] = $this->teamMapper->map($item);
        }
        return $teams;
    }

    public function getTeam(string $url): TeamDTO
    {
        $rawData = $this->scraper->fetchTeamData($url);
        return $this->teamMapper->map($rawData);
    }
}
