<?php

namespace App\Jobs\Sync\Tournament;

use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use App\Models\Tournament;
use App\Utils\SlugHelper;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class SyncTournamentSeasonsJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    private Tournament $tournament;

    /**
     * Create a new job instance.
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->model = $tournament;
    }

    public function uniqueId(): string
    {
        return get_class($this->tournament) . '-seasons-' . $this->tournament->id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (false === config('sync.syncInactive') && $this->tournament->getIsActive() === false) {
            info('Tournament is inactive', ['tournament' => $this->tournament->id]);
            return;
        }

        $url = $this->getUrl();
        $data = $this->getData($url);
        $data = $data['data'] ?? [];
        $tournamentSourceId = $this->tournament->getSourceId();

        if (!empty($data)) {
            $conn = DB::connection('mongodbOsSport');
            $data = array_map(function ($season) use ($tournamentSourceId) {
                return $season + [
                    'tournament' => ['id' => $tournamentSourceId],
                    'created_at' => Carbon::now()->timestamp,
                ];
            }, $data);
            //$conn->table('season')->updateOrInsert($data);
            $conn->table('season')->insert($data);

            info('Tournament seasons data not found', ['tournament' => $this->tournament->id]);
            foreach ($data as $newSeason) {

                $season = Season::query()->where('source_id', $newSeason['id'])->first();

                if (empty($season)) {
                    $season = new Season();
                    $season->setSourceId($newSeason['id']);
                }

                $season->setName($newSeason['name']);
                $season->setSlug(SlugHelper::generateSlug($newSeason['name']));
                $season->setYear($newSeason['year']);
                $season->setTournamentId($this->tournament->id);
                $season->save();

            }
        }
    }

    private function getUrl(): string
    {
        return 'unique-tournaments/seasons?unique_tournament_id=' . $this->tournament->getSourceId();
    }

    private function getExampleData(): array
    {

        $jayParsedAry = [
            "data" => [
                [
                    "name" => "Premier League 24/25",
                    "year" => "24/25",
                    "editor" => false,
                    "id" => 61627
                ],
                [
                    "name" => "Premier League 23/24",
                    "year" => "23/24",
                    "editor" => false,
                    "id" => 52186
                ],
            ]
        ];

        return $jayParsedAry;
    }
}
