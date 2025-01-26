<?php

namespace App\Console\Commands\MVPSync\Match;

use App\Jobs\Sync\Match\SyncMatchLineupJob;
use App\Jobs\Sync\Season\SyncSeasonStatisticJob;
use App\Models\MatchEvent;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class MatchLineup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:match-lineup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $matches = MatchEvent::query()
            ->where(function ($query) {
                $query->whereNull('last_sync')
                    ->orWhere('last_sync', '<=', Carbon::now()->subDay());
            })
            ->get();

        foreach ($matches as $match) {
            $this->info("Syncing season matches: {$match->slug} - {$match->id}");

            Bus::chain([
                new SyncMatchLineupJob($match),
            ])->onQueue('default')->dispatch();
        }

        $this->info('Synced match lineups');
    }
}
