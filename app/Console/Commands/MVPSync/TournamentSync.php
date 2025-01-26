<?php

namespace App\Console\Commands\MVPSync;

use App\Jobs\Sync\Tournament\SyncTournamentDataJob;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Console\Command;

class TournamentSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:tournament-sync';

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
            $this->info("Syncing tournament: {$tournament->name} - {$tournament->id}");
            SyncTournamentDataJob::dispatch($tournament)->onQueue('default');
        }

        $this->info('Synced tournaments');
    }
}
