<?php

namespace App\Console\Commands\MVPSync\Sync\Season;

use App\Jobs\Sync\Team\TeamSeasonStatisticJob;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class SeasonTopTeamStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:season-top-team-statistic-command';

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
            $this->info("Syncing season top teams: {$season->name} - {$season->id}");

            Bus::chain([
                new TeamSeasonStatisticJob($season),
            ])->onQueue('default')->dispatch();
        }

        $this->info('Synced seasons top teams');
    }
}
