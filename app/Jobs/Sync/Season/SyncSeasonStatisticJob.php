<?php

namespace App\Jobs\Sync\Season;

use App\Builder\Season\SeasonStatisticBuilder;
use App\Builder\Season\SeasonTeamBuilder;
use App\Builder\Team\TeamBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSeasonStatisticJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
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
        return get_class($this->season) . '-statistic:' . $this->season->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if (false === config('sync.syncInactive') && $this->season->getIsActive() === false) {
                info('Season is inactive', ['season' => $this->season->id]);
                return;
            }

            $lastSync = $this->season->getLastSync();

            if (!empty($lastSync) && $this->getLastSyncComparatorDate()->lessThan($lastSync)) {
                info('Season last sync is less than a day', ['season' => $this->season->id]);
                return;
            }

            $data = $this->getData($this->getUrl($this->season));
            //$data = $this->getExampleData();

            $data = $data['data'] ?? [];

            if (empty($data)) {
                info('Season statistic is empty', ['season' => $this->season->id]);
                return;
            }

            $seasonStatistic = SeasonStatisticBuilder::build($this->season, $data);
            $seasonStatistic->save();

            if (!empty($data['newcomersUpperDivision'])) {
                foreach ($data['newcomersUpperDivision'] as $newcomerTeam) {
                    $team = TeamBuilder::build($newcomerTeam, $this->season->tournament->sport);
                    $team->save();

                    $seasonTeam = SeasonTeamBuilder::build($this->season, $team, true);
                    $seasonTeam->save();
                }
            }

            if (!empty($data['newcomersLowerDivision'])) {
                foreach ($data['newcomersLowerDivision'] as $newcomerTeam) {
                    $team = TeamBuilder::build($newcomerTeam, $this->season->tournament->sport);
                    $team->save();

                    $seasonTeam = SeasonTeamBuilder::build($this->season, $team, false, true);
                    $seasonTeam->save();
                }
            }
        } catch (\Throwable $e) {
            info('Season statistic sync failed', ['season' => $this->season->id, 'exception' => $e->getMessage()]);
            return;
        }
    }

    public function getUrl(Season $season): string
    {
        return 'seasons/details?seasons_id=' . $season->getSourceId() . '&unique_tournament_id=' . $season->tournament->getSourceId();
    }

    public function getExampleData(): array
    {

        $arrayVar = [
            "data" => [
                "goals" => 1071,
                "homeTeamWins" => 163,
                "awayTeamWins" => 129,
                "draws" => 88,
                "yellowCards" => 1341,
                "redCards" => 43,
                "numberOfRounds" => 38,
                "newcomersUpperDivision" => [],
                "newcomersLowerDivision" => [],
                "newcomersOther" => [],
                "numberOfCompetitors" => 20,
                "id" => 16421,
                "hostCountries" => ["England"],
            ],
        ];

        return $arrayVar;
    }
}
