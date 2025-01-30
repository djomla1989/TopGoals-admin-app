<?php

namespace App\Console\Commands\MVPSync\Sync\Season;

use App\Jobs\Sync\Season\SyncSeasonRoundsTeamOfTheWeekPlayerJob;
use App\Models\SeasonRound;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class SeasonRoundTeamOfTheWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:season-round-team-of-the-week';

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
        $seasonRounds = SeasonRound::query()
            ->where(function ($query) {
                $query->whereNull('last_sync')
                    ->orWhere('last_sync', '<=', Carbon::now()->subDay());
            })
            ->get();

        /** @var \App\Console\Commands\MVPSync\Sync\Season\SeasonRound $seasonRound */
        foreach ($seasonRounds as $seasonRound) {
            $this->info("Syncing season rounds: {$seasonRound->name} - {$seasonRound->id}");

            Bus::chain([
                new SyncSeasonRoundsTeamOfTheWeekPlayerJob($seasonRound),
            ])->onQueue('default')->dispatch();

            //$seasonRound->setLastSync(Carbon::now())->save();
        }

        $this->info('Synced seasons round team of the week');
    }
}
