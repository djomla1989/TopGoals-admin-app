<?php

namespace App\Services\Scrapers\Team\Icon\Providers;

use App\Models\AllSports\TeamAllSports;
use App\Services\Scrapers\IconProviderInterface;
use App\Services\Scrapers\ImageScraperServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * @implements IconProviderInterface<TeamAllSports>
 */
class LiveScoresBizTeamIconProvider implements IconProviderInterface
{
    protected ImageScraperServiceInterface $imageScraperService;

    public function __construct(ImageScraperServiceInterface $imageScraperService)
    {
        $this->imageScraperService = $imageScraperService;
    }

    public function fetchIconUrl(Model $model): ?string
    {
        try {
            /** @var TeamAllSports $team */
            $team = $model;
            $sport = $team->sport->id;
            $slug = $team->slug;
            $urlList = [];

            $imageSelector = 'img.team-logo';

            $url = "https://livescores.biz/{$sport}/team/{$slug}";
            $urlList[] = $url;

            $response = $this->imageScraperService->getImageSrc($url, $imageSelector);

            if (!empty($response)) {
                return $response;
            }

            $nameSlug = Str::slug($team->name);
            $urlNameSlug = "https://livescores.biz/{$sport}/team/{$nameSlug}";

            if ($urlNameSlug !== $url) {
                $urlList[] = $urlNameSlug;
                $response = $this->imageScraperService->getImageSrc($urlNameSlug, $imageSelector);

                if (!empty($response)) {
                    return $response;
                }
            }

            //check if $tournament->slug have "-$number" at the end
            //if not, add -1
            if (!preg_match('/-\d+$/', $slug)) {
                $slug .= '-1';
                $url = "https://livescores.biz/{$sport}/team/{$slug}";
                $urlList[] = $url;

                $response = $this->imageScraperService->getImageSrc($url, $imageSelector);

                if (!empty($response)) {
                    return $response;
                }
            }
        } catch (\Exception $exception) {
            Log::channel('sport_icon')->error('FAILED to fetch team icon :: '.__FILE__,
                [
                    'team_id' => $team->id,
                    'team_slug' => $team->slug,
                    'url' => json_encode($urlList),
                    'error' => $exception->getMessage()
                ]);
        }

        Log::channel('sport_icon')->info('FAILED to fetch team icon :: '.__FILE__,
            [
                'team_id' => $team->id,
                'team_id_slug' => $team->slug,
                'url' => json_encode($urlList)
            ]
        );

        return null;
    }
}
