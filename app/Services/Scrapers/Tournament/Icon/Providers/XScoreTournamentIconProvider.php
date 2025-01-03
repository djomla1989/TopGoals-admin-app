<?php

namespace App\Services\Scrapers\Tournament\Icon\Providers;


use App\Models\AllSports\TournamentAllSports;
use App\Services\Scrapers\IconProviderInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * @implements IconProviderInterface<TournamentAllSports>
 */
class XScoreTournamentIconProvider implements IconProviderInterface
{
    protected HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchIconUrl(Model $model): ?string
    {
        try {
            $urlList = [];
            $url = '';
            /** @var TournamentAllSports $tournament */
            $tournament = $model;
            $category = $tournament->category;
            $categoryName = Str::slug($category->name);

            $url = "https://xscore.cc/resb/league/{$categoryName}-{$tournament->slug}.png";
            $urlList[] = $url;

            $response = $this->httpClient->get($url);
            if ($response->status() === 200) {
                return $url;
            }

            $nameSlug = Str::slug($tournament->name);
            $urlNameSlug = "https://xscore.cc/resb/league/{$categoryName}-{$nameSlug}.png";
            if ($urlNameSlug !== $url) {
                $url = $urlNameSlug;
                $urlList[] = $url;
                $response = $this->httpClient->get($url);
                if ($response->status() === 200) {
                    return $urlNameSlug;
                }
            }

            //check if $tournament->slug have "-$number" at the end
            //if not, add -1
            $slug = $tournament->slug;
            if (!preg_match('/-\d+$/', $slug)) {
                $slug .= '-1';
                $url = "https://xscore.cc/resb/league/{$categoryName}-{$slug}.png";
                $urlList[] = $url;

                $response = $this->httpClient->get($urlNameSlug);
                if ($response->status() === 200) {
                    return $urlNameSlug;
                }
            }
        } catch (\Exception $exception) {
            Log::channel('sport_icon')->error('FAILED to fetch tournament icon  :: '.__FILE__,
                [
                    'tournament_id' => $tournament->id,
                    'tournament_slug' => $tournament->slug,
                    'url' => json_encode($urlList),
                    'error' => $exception->getMessage()
                ]);
        }

        Log::channel('sport_icon')->info('FAILED to fetch tournament icon :: '.__FILE__,
            [
                'tournament_id' => $tournament->id,
                'tournament_slug' => $tournament->slug,
                'url' => json_encode($urlList)
            ]
        );

        return null;
    }
}
