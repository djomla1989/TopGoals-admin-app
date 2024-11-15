<?php

namespace App\Console\Commands\SportsImport;

use App\Jobs\ProcessTournamentSeasonNextEvents;
use App\Models\Sport;
use App\Models\Tournament;
use App\Models\TournamentSeason;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportTournamentSeasonNextEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tournament-seasons-next-events {--overwrite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import all tournament seasons next events data from MongoDB collection';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $conn = DB::connection('mongodb');
        $tournamentSeasonNextEventList = $conn->table('uniqueTournamentSeasonNextEvents')->orderBy('uniqueTournament.id')->get();

        foreach ($tournamentSeasonNextEventList as $nextEvent) {
            ProcessTournamentSeasonNextEvents::dispatch($nextEvent);

            $this->info('Job created: '.$nextEvent['uniqueTournament']['id']);

        }

        $this->info('All tournament seasons next events sent to queue');
    }
}
