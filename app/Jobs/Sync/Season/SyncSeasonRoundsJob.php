<?php

namespace App\Jobs\Sync\Season;

use App\Builder\Season\SeasonRoundBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSeasonRoundsJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    private Season $season;

    /**
     * Create a new job instance.
     */
    public function __construct(Season $season)
    {
        $this->season = $season;
    }

    public function uniqueId(): string
    {
        return get_class($this->season) . '-rounds-' . $this->season->id;
    }

    public function failed(\Throwable $exception): void
    {
        info('Season rounds data sync failed', [
            'season' => $this->season->id,
            'exception' => $exception->getMessage()
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (false === config('sync.syncInactive') && $this->season->getIsActive() === false) {
            info('Season is inactive', ['season' => $this->season->id]);
            return;
        }

        $lastSync = $this->season->getLastSync();

        if (!empty($lastSync) && $this->getLastSyncComparatorDate()->lessThan($lastSync)) {
            info('Season last sync is less than a day', ['season' => $this->season->id]);
            return;
        }

        $data = $this->getData($this->getUrl());
        //$data = $this->getExampleData();

        $data = $data['data'] ?? [];

        if (empty($data) || empty($data[0])) {
            info('Season statistic is empty', ['season' => $this->season->id]);
            return;
        }

        foreach ($data as $roundData) {
            $seasonRound = SeasonRoundBuilder::build($this->season, $roundData);
            $seasonRound->save();
        }

        info('Season rounds data synced', ['season' => $this->season->id]);
    }

    public function getUrl(): string
    {
        return sprintf(
            'seasons/team-week/rounds?seasons_id=%s&unique_tournament_id=%s',
            $this->season->getSourceId(),
            $this->season->tournament->getSourceId()
        );
    }

    public function getExampleData(): array
    {

        $jayParsedAry = [
            "data" => [
                [
                    "roundId" => 22,
                    "roundName" => "22",
                    "roundSlug" => "22:22",
                    "id" => 16915,
                    "createdAtTimestamp" => 1737444988
                ],
                [
                    "roundId" => 21,
                    "roundName" => "21",
                    "roundSlug" => "21:21",
                    "id" => 16878,
                    "createdAtTimestamp" => 1737102144
                ],
                [
                    "roundId" => 20,
                    "roundName" => "20",
                    "roundSlug" => "20:20",
                    "id" => 16726,
                    "createdAtTimestamp" => 1736235608
                ],
                [
                    "roundId" => 19,
                    "roundName" => "19",
                    "roundSlug" => "19:19",
                    "id" => 16705,
                    "createdAtTimestamp" => 1735805553
                ],
                [
                    "roundId" => 18,
                    "roundName" => "18",
                    "roundSlug" => "18:18",
                    "id" => 16680,
                    "createdAtTimestamp" => 1735371336
                ],
                [
                    "roundId" => 17,
                    "roundName" => "17",
                    "roundSlug" => "17:17",
                    "id" => 16631,
                    "createdAtTimestamp" => 1734941054
                ],
                [
                    "roundId" => 16,
                    "roundName" => "16",
                    "roundSlug" => "16:16",
                    "id" => 16567,
                    "createdAtTimestamp" => 1734420513
                ],
                [
                    "roundId" => 15,
                    "roundName" => "15",
                    "roundSlug" => "15:15",
                    "id" => 16474,
                    "createdAtTimestamp" => 1733818721
                ],
                [
                    "roundId" => 14,
                    "roundName" => "14",
                    "roundSlug" => "14:14",
                    "id" => 16409,
                    "createdAtTimestamp" => 1733471585
                ],
                [
                    "roundId" => 13,
                    "roundName" => "13",
                    "roundSlug" => "13:13",
                    "id" => 16307,
                    "createdAtTimestamp" => 1733125878
                ],
                [
                    "roundId" => 12,
                    "roundName" => "12",
                    "roundSlug" => "12:12",
                    "id" => 16237,
                    "createdAtTimestamp" => 1732606443
                ],
                [
                    "roundId" => 11,
                    "roundName" => "11",
                    "roundSlug" => "11:11",
                    "id" => 15959,
                    "createdAtTimestamp" => 1731312886
                ],
                [
                    "roundId" => 10,
                    "roundName" => "10",
                    "roundSlug" => "10:10",
                    "id" => 15868,
                    "createdAtTimestamp" => 1730796411
                ],
                [
                    "roundId" => 9,
                    "roundName" => "9",
                    "roundSlug" => "9:9",
                    "id" => 15681,
                    "createdAtTimestamp" => 1730106762
                ],
                [
                    "roundId" => 8,
                    "roundName" => "8",
                    "roundSlug" => "8:8",
                    "id" => 15563,
                    "createdAtTimestamp" => 1729579528
                ],
                [
                    "roundId" => 7,
                    "roundName" => "7",
                    "roundSlug" => "7:7",
                    "id" => 15322,
                    "createdAtTimestamp" => 1728285631
                ],
                [
                    "roundId" => 6,
                    "roundName" => "6",
                    "roundSlug" => "6:6",
                    "id" => 15196,
                    "createdAtTimestamp" => 1727770735
                ],
                [
                    "roundId" => 5,
                    "roundName" => "5",
                    "roundSlug" => "5:5",
                    "id" => 15006,
                    "createdAtTimestamp" => 1727074027
                ],
                [
                    "roundId" => 4,
                    "roundName" => "4",
                    "roundSlug" => "4:4",
                    "id" => 14857,
                    "createdAtTimestamp" => 1726473269
                ],
                [
                    "roundId" => 3,
                    "roundName" => "3",
                    "roundSlug" => "3:3",
                    "id" => 14620,
                    "createdAtTimestamp" => 1725261293
                ],
                [
                    "roundId" => 2,
                    "roundName" => "2",
                    "roundSlug" => "2:2",
                    "id" => 14402,
                    "createdAtTimestamp" => 1724655124
                ],
                [
                    "roundId" => 1,
                    "roundName" => "1",
                    "roundSlug" => "1:1",
                    "id" => 14260,
                    "createdAtTimestamp" => 1724139906
                ]
            ]
        ];

        return $jayParsedAry;
    }
}
