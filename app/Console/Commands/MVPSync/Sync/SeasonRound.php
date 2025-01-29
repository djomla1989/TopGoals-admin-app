<?php

namespace App\Console\Commands\MVPSync\Sync;

use App\Jobs\Sync\Season\SyncSeasonRoundsJob;
use App\Jobs\Sync\Season\SyncSeasonStandingJob;
use App\Jobs\Sync\Season\SyncSeasonStatisticJob;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class SeasonRound extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:season-rounds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $seasons = Season::query()
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('last_sync')
                    ->orWhere('last_sync', '<=', Carbon::now()->subDay());
            })
            ->get();

        foreach ($seasons as $season) {
            $this->info("Syncing season rounds: {$season->name} - {$season->id}");

            Bus::chain([
                new SyncSeasonRoundsJob($season),
            ])->onQueue('default')->dispatch();
        }

        $this->info('Synced seasons rounds');
    }
}
