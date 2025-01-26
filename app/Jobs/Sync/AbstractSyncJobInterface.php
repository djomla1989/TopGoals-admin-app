<?php

namespace App\Jobs\Sync;

use App\Jobs\OsSports\MatchEvent;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Database\Eloquent\Model;

interface AbstractSyncJobInterface
{
    public function getData(string $url): ?array;
}
