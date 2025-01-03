<?php

namespace App\Services\Scrapers\Tournament\Icon\Providers;


use App\Models\AllSports\TournamentAllSports;
use App\Services\Scrapers\IconProviderInterface;
use App\Services\Scrapers\ImageScraperServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * @implements IconProviderInterface<TournamentAllSports>
 */
class FlashScoreTournamentIconProvider implements IconProviderInterface
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
            /** @var TournamentAllSports $tournament */
            $tournament = $model;
            $slug = $tournament->slug;
            $urlList = [];

            $flashScoreSportName = $this->mapSportName($tournament->sport_id);
            $country = Str::slug($tournament->category->name);

            if (!$flashScoreSportName) {
                return null;
            }

            $imageSelector = 'img.heading__logo.heading__logo--1';

            $randomUrlDomain = array_random(self::FLASHSCORE_DOMAINS);

            $url = $flashScoreSportName .'/'. $country . '/'. $slug;

            $urlList[] = $randomUrlDomain . "/" . $url;
            $response = $this->imageScraperService->getImageSrc($randomUrlDomain . "/" . $url, $imageSelector);

            if (!empty($response)) {
                return $response;
            }

            $nameSlug = Str::slug($tournament->name);
            $urlNameSlug = $flashScoreSportName .'/'. $country . '/'.$nameSlug;

            if ($urlNameSlug !== $url) {
                $url = $urlNameSlug;
                $randomUrlDomain = array_random(self::FLASHSCORE_DOMAINS);
                $response = $this->imageScraperService->getImageSrc($randomUrlDomain . "/" . $url, $imageSelector);
                $urlList[] = $randomUrlDomain . "/" . $url;

                if (!empty($response)) {
                    return $response;
                }
            }

            //check if $tournament->slug have "-$number" at the end
            //if not, add -1
            if (!preg_match('/-\d+$/', $slug)) {
                $slug .= '-1';
                $url = $flashScoreSportName .'/'. $country . '/'.$slug;
                $randomUrlDomain = array_random(self::FLASHSCORE_DOMAINS);
                $response = $this->imageScraperService->getImageSrc($randomUrlDomain . "/" . $url, $imageSelector);
                $urlList[] = $randomUrlDomain . "/" . $url;

                if (!empty($response)) {
                    return $response;
                }
            }
        } catch (\Exception $exception) {
            Log::channel('sport_icon')->error('FAILED to fetch tournament icon :: ' . __FILE__,
                [
                    'tournament_id'     => $tournament->id,
                    'tournament_slug'   => $tournament->slug,
                    'url'               => json_encode($urlList),
                    'error' => $exception->getMessage()
                ]);
        }

        Log::channel('sport_icon')->info('FAILED to fetch tournament icon :: ' . __FILE__,
            [
                'tournament_id' => $tournament->id,
                'tournament_slug' => $tournament->slug,
                'url' => json_encode($urlList),
            ]
        );

        return null;
    }

    private function mapSportName(string $sport): ?string
    {
        return match ($sport) {
            'soccer' => 'football',
            'tennis' => 'tennis',
            'basketball' => 'basketball',
            'cricket' => 'cricket',
            default => null,
        };
    }
}
