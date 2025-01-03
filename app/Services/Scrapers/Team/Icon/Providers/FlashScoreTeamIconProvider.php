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
class FlashScoreTeamIconProvider implements IconProviderInterface
{
    const FLASHSCORE_DOMAINS = [
        'https://www.flashscore.com',
        'https://www.flashscore.com.ng',
        'https://www.flashscore.co.uk',
        'https://www.flashscore.co.ke',
        'https://www.flashscore.com.au',
        'https://www.flashscore.ca',
    ];

    protected ImageScraperServiceInterface $imageScraperService;

    public function __construct(ImageScraperServiceInterface $imageScraperService)
    {
        $this->imageScraperService = $imageScraperService;
    }

    public function fetchIconUrl(Model $model): ?string
    {
        try {
            //TODO:
            // this is url https://www.flashscore.co.uk/team/central-conn-st/rTxTTih6/
            // there is hash at the end of the url, we need find it
            // I can get list of all teams in league
            // STEP 1: https://www.flashscore.co.uk/basketball/croatia/premijer-liga/standings/
            // read "season_list": [{
            //    "id": 0,
            //    "name": "2024\/2025",
            //    "pathname": "\/standings\/EBAV4rNg\/bDACLXAh\/"
            //   }, {
            //    "id": 1,
            //      "name": "2023\/2024",
            //       "pathname": "\/standings\/6osegP3s\/bHpM88Eb\/"
            //     },
            // STEP 2:
            // commbine tournament id with seasons ID and get list of teams
            // https://5.flashscore.ninja/5/x/feed/to_EBAV4rNg_bDACLXAh_1
            // STEP 3:
            // Parse teams and get name/slug/image
            return null;
            /** @var TeamAllSports $team */
            $team = $model;
            $slug = $team->slug;
            $urlList = [];


            $imageSelector = 'img.heading__logo.heading__logo--1';

            $randomUrlDomain = array_random(self::FLASHSCORE_DOMAINS);

            $url = '/team/' . $slug;

            $urlList[] = $randomUrlDomain . "/" . $url;
            $response = $this->imageScraperService->getImageSrc($randomUrlDomain . "/" . $url, $imageSelector);

            if (!empty($response)) {
                return $response;
            }

            $nameSlug = Str::slug($team->name);
            $urlNameSlug = '/team/' .$nameSlug;

            if ($urlNameSlug !== $url) {
                $url = $urlNameSlug;
                $randomUrlDomain = array_random(self::FLASHSCORE_DOMAINS);
                $response = $this->imageScraperService->getImageSrc($randomUrlDomain . "/" . $url, $imageSelector);
                $urlList[] = $randomUrlDomain . "/" . $url;

                if (!empty($response)) {
                    return $response;
                }
            }

            //check if $team->slug have "-$number" at the end
            //if not, add -1
            if (!preg_match('/-\d+$/', $slug)) {
                $slug .= '-1';
                $url = '/team/' .$slug;
                $randomUrlDomain = array_random(self::FLASHSCORE_DOMAINS);
                $response = $this->imageScraperService->getImageSrc($randomUrlDomain . "/" . $url, $imageSelector);
                $urlList[] = $randomUrlDomain . "/" . $url;

                if (!empty($response)) {
                    return $response;
                }
            }
        } catch (\Exception $exception) {
            Log::channel('sport_icon')->error('FAILED to fetch team icon :: ' . __FILE__,
                [
                    'team_id'     => $team->id,
                    'team_slug'   => $team->slug,
                    'url'         => json_encode($urlList),
                    'error' => $exception->getMessage()
                ]);
        }

        Log::channel('sport_icon')->info('FAILED to fetch team icon :: ' . __FILE__,
            [
                'team_id'   => $team->id,
                'team_slug' => $team->slug,
                'url' => json_encode($urlList),
            ]
        );

        return null;
    }
}
