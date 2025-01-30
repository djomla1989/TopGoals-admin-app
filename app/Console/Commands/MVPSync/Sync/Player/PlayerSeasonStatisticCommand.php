<?php

namespace App\Console\Commands\MVPSync\Sync\Player;

use App\Jobs\Sync\Player\SyncPlayerSeasonStatisticJob;
use App\Jobs\Sync\Season\SyncSeasonRoundsJob;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class PlayerSeasonStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:player-season-statistic-command';

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
                new SyncPlayerSeasonStatisticJob($season),
            ])->onQueue('default')->dispatch();
        }

        $this->info('Synced seasons top players');
    }
}
