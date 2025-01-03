<?php

namespace App\Jobs\Mapper;

use App\Models\AllSports\TournamentSeasonAllSports;
use App\Models\DataMapping;
use App\Models\Tipster\TournamentSeasonsTipster;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class MapSeasonJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(DataMapping $dataMapping)
    {
        if ($dataMapping->table_name !== 'tournaments') {
            abort(404, 'Mapping not found.');
        }

        $sourceSeasons = TournamentSeasonAllSports::where('tournament_id', $dataMapping->source_id)->get();

        $mapSeason = TournamentSeasonsTipster::where('tournament_id', $dataMapping->tipster_table_id)->orderBy('name')->get();

        $totalMappings = 0;
        foreach ($sourceSeasons as $itemA) {
            $yearA = strtolower($itemA->year);

            Log::info('##########');
            Log::info('Processing: '.$itemA->year);

            foreach ($mapSeason as $itemB) {
                $yearB = strtolower($itemB->year);
                $yearBReplace = preg_replace('/(\d{2})(\d{2})-(\d{2})(\d{2})/', '$2/$4', $itemB->year);

                if ($yearA === $yearB || $yearA === $yearBReplace) {
                    $totalMappings++;
                    Log::info('Matched: '.$itemA->year.' - '.$itemB->year);
                    DataMapping::updateOrCreate(
                        ['source_id' => $itemA->id, 'table_name' => 'seasons'],
                        ['tipster_table_id' => $itemB->id]
                    );

                }
            }
        }

        Log::info('##########');
        Log::info('Mapping done.');
        Log::info('Total mappings: '.$totalMappings);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
