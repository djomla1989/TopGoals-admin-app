<?php

namespace App\Console\Commands\MVPSync\Create;

use App\Jobs\Sync\Tournament\SyncTournamentSeasonsJob;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SeasonCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tournament-season-create';

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
        $tournaments = Tournament::query()
            ->where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('last_sync')
                    ->orWhere('last_sync', '<=', Carbon::now()->subDay());
            })
            ->get();

        foreach ($tournaments as $tournament) {
            $this->info("Syncing tournament season: {$tournament->name} - {$tournament->id}");
            SyncTournamentSeasonsJob::dispatch($tournament)->onQueue('default');
        }

        $this->info('Synced tournament seasons');
    }
}
