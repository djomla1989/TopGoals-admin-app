<?php

namespace App\Console\Commands\MVPSync\Sync\Team;

use App\Jobs\Sync\Team\TeamInfoJob;
use App\Models\Team;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;

class TeamInfoCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:team-info-command {--team_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync team info';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $teamId = $this->option('team_id');

        $teamQuery = Team::query()
            ->where(function ($query) {
                $query->where('is_active', true);
                $query->whereNull('last_sync')
                    ->orWhere('last_sync', '<=', Carbon::now()->subDay());
            });

        if ($teamId) {
            $teamQuery->where('id', $teamId);
        }

        $teamList = $teamQuery->get();

        foreach ($teamList as $team) {
            $this->info("Syncing team info: {$team->name} - {$team->id}");
            Bus::chain([
                new TeamInfoJob($team),
            ])->onQueue('default')->dispatch();
        }

        $this->info('Synced team info');

    }
}
