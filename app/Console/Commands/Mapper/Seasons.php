<?php

namespace App\Console\Commands\Mapper;

use App\Jobs\Mapper\MapSeasonJob;
use App\Models\DataMapping;
use App\Models\Tipster\TournamentSeasonsTipster;
use Illuminate\Console\Command;

class Seasons extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mapper:seasons';

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
        $allMappedTournaments = DataMapping::where('table_name', 'tournaments')->get()->keyBy('source_id');

        foreach ($allMappedTournaments as $mappedTournament) {
            $hasSeasons = TournamentSeasonsTipster::where('tournament_id', $mappedTournament->tipster_table_id)->exists();
            if ($hasSeasons === false) {
                continue;
            }
            $syncSeasonJos = new MapSeasonJob($mappedTournament);

            dispatch($syncSeasonJos);
        }
    }
}
