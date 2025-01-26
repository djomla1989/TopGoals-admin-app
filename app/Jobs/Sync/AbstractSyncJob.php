<?php

namespace App\Jobs\Sync;

use Carbon\Carbon;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;
use Spatie\RateLimitedMiddleware\RateLimited;

abstract class AbstractSyncJob implements AbstractSyncJobInterface
{
    public Model $model;

    public function middleware(): array
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(config('sync.rateLimit.jobs'))
            ->everySeconds(config('sync.rateLimit.interval'))
            ->releaseAfterSeconds(config('sync.rateLimit.releaseAfter'));

        return [$rateLimitedMiddleware];
    }

    public function getLastSyncComparatorDate(int $days = 1): Carbon
    {
        return Carbon::now()->subDays($days);
    }

    public function getData($url): ?array
    {
        $client = new Client;
        $api_url = config('os-sports.api_url');
        $api_host = config('os-sports.api_host');
        $api_key = config('os-sports.api_key');

        try {
            $response = $client->request('GET', "{$api_url}{$url}", [
                'headers' => [
                    'x-rapidapi-host' => $api_host,
                    'x-rapidapi-key' => $api_key,
                ],
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (RequestException $ex) {

            if ($ex->hasResponse()) {
                $statusCode = $ex->getResponse()->getStatusCode();

                if ($statusCode == 429) {
                    $newJob = clone $this;
                    self::dispatch($newJob)->delay(now()->addSeconds(random_int(1, 60)));
                } else {
                    info('Error API');
                    info($ex->getMessage());
                }
            } else {
                info('Error API');
                info($ex->getMessage());
            }

            return null;
        }
    }
}
