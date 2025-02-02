<?php

namespace App\Console\Commands\MVPSync\Sync\Team;

use App\Jobs\Sync\Team\TeamSeasonStatisticJob;
use App\Models\Season;
use App\Models\SeasonTeam;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;

class TeamSeasonStatisticCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:team-season-statistic-command {--season_id=} {--team_id=} {--limit=}';

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
        $seasonId = $this->option('season_id');
        $teamId = $this->option('team_id');
        $limit = $this->option('limit');

        $seasonTeams = SeasonTeam::query()
            ->join(DB::raw('seasons FORCE INDEX(PRIMARY)'), 'season_teams.season_id', '=', 'seasons.id')
            ->where(function ($query) {
                $query->where('seasons.is_active', true);
                $query->whereNull('seasons.last_sync')
                    ->orWhere('seasons.last_sync', '<=', Carbon::now()->subDay());
            })
            ->select('season_teams.*');

        if ($seasonId) {
            $seasonTeams->where('season_teams.season_id', $seasonId);
        }

        if ($teamId) {
            $seasonTeams->where('season_teams.team_id', $teamId);
        }

        if ($limit) {
            $seasonTeams->limit($limit);
        }

        $seasonTeams = $seasonTeams->get();

        /** @var SeasonTeam $seasonTeam */
        foreach ($seasonTeams as $seasonTeam) {
            $this->info("Syncing team season stats: {$seasonTeam->team->name} - {$seasonTeam->team->id} - {$seasonTeam->season->name} - {$seasonTeam->season->id}");

            Bus::chain([
                new TeamSeasonStatisticJob($seasonTeam->season, $seasonTeam->team),
            ])->onQueue('default')->dispatch();
        }

        $this->info('Synced seasons top teams');
    }
}
