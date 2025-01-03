<?php

namespace App\Services\Scrapers\Team\Icon\Providers;

use App\Models\AllSports\TeamAllSports;
use App\Services\Scrapers\IconProviderInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Client\Factory as HttpClient;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * @implements IconProviderInterface<TeamAllSports>
 */
class XScoreTeamIconProvider implements IconProviderInterface
{
    protected HttpClient $httpClient;

    public function __construct(HttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    public function fetchIconUrl(Model $model): ?string
    {
        try {
            /** @var TeamAllSports $team */
            $team = $model;
            $slug = $team->slug;

            $url = "https://xscore.cc/resb/team/{$slug}.png";

            $response = $this->httpClient->get($url);

            if ($response->status() === 200) {
                return $url;
            }

            $nameSlug = Str::slug($team->name);
            $urlNameSlug = "https://xscore.cc/resb/team/{$nameSlug}.png";

            if ($urlNameSlug !== $url) {
                $response = $this->httpClient->get($urlNameSlug);

                if ($response->status() === 200) {
                    return $urlNameSlug;
                }
            }

            //check if $tournament->slug have "-$number" at the end
            //if not, add -1
            if (!preg_match('/-\d+$/', $slug)) {
                $slug .= '-1';
                $url = "https://xscore.cc/resb/team/{$slug}.png";

                $response = $this->httpClient->get($url);
                if ($response->status() === 200) {
                    return $url;
                }
            }
        } catch (\Exception $exception) {
            Log::channel('sport_icon')->error('FAILED to fetch team icon :: '.__FILE__,
                [
                    'team_id' => $team->id,
                    'team_slug' => $team->slug,
                    'url' => $url,
                    'error' => $exception->getMessage()
                ]);
        }

        Log::channel('sport_icon')->info('FAILED to fetch team icon :: '.__FILE__,
            [
                'team_id' => $team->id,
                'team_id_slug' => $team->slug,
                'url' => $url
            ]
        );

        return null;
    }
}
