<?php

namespace App\Jobs;

use App\Models\Category;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentSeason;
use App\Models\TournamentSeasonGroup;
use App\Models\TournamentSeasonNextEvent;
use Database\Factories\CategoryFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TournamentFactory;
use Database\Factories\TournamentSeasonFactory;
use Database\Factories\TournamentSeasonGroupFactory;
use Database\Factories\TournamentSeasonNextEventFactory;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ProcessTournamentSeasonNextEvents implements ShouldQueue
{
    use Queueable;

    protected array $data;

    protected bool $debug = false;

    protected bool $overwrite = false;

    /**
     * Create a new job instance.
     */
    public function __construct(
        array $tournamentSeasonNextEventsData,
        bool $debug = false,
        bool $overwrite = false
    ) {
        $this->data = $tournamentSeasonNextEventsData;
        $this->debug = $debug;
        $this->overwrite = $overwrite;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();

        try {

            $data = json_decode(json_encode($this->data));

            $tournament = Tournament::query()->where('import_id', $data->uniqueTournament->id)->first();
            $season = TournamentSeason::query()->where('import_id', $data->uniqueTournamentSeason->id)->first();
            $sport = Sport::query()->where('name', Sport::FOOTBALL)->first();

            $this->writeLog('Processing tournament season next events: '.$data->uniqueTournamentSeason->id, true);

            $firstEvent = $data->events[0];
            if (empty($firstEvent)) {
                $this->writeLog('No events found for tournament season '.$data->uniqueTournamentSeason->id, true);

                return;
            }

            $category = Category::query()->where('import_id', $firstEvent->tournament->category->id)->first();

            if (empty($category)) {
                $category = CategoryFactory::buildFromNextEvent($firstEvent);
                $category->save();
            }

            if (empty($tournament)) {
                $this->writeLog('Tournament not found for tournament season : '.$data->uniqueTournament->id.' try to create ', true);
                $tournament = TournamentFactory::buildFromNextEvent($firstEvent, $sport->id, $category->id);
                $tournament->save();
            }

            if (empty($season)) {
                $season = TournamentSeasonFactory::buildFromNextEvent($firstEvent, $tournament->id);
                $season->save();
            }

            $eventForSave = [];
            foreach ($data->events as $event) {

                $eventExist = TournamentSeasonNextEvent::query()
                    ->where('import_id', $event->id)
                    ->first();
                if (! empty($eventExist) && $this->overwrite === false) {
                    $this->writeLog('Event already exist:'.$event->id, true);

                    continue;
                }

                $homeTeam = Team::query()->where('import_id', $event->homeTeam->id)->first();
                $awayTeam = Team::query()->where('import_id', $event->awayTeam->id)->first();
                $tournamentSeasonGroup = TournamentSeasonGroup::query()->where('import_id', $event->tournament->id)->first();

                if (empty($homeTeam)) {
                    $homeTeam = TeamFactory::buildFromTeam(
                        $event->homeTeam,
                        $season->tournament->sport_id,
                        $season->tournament->category_id,
                        $season->tournament_id
                    );
                    $homeTeam->save();
                }

                if (empty($awayTeam)) {
                    $awayTeam = TeamFactory::buildFromTeam(
                        $event->awayTeam,
                        $season->tournament->sport_id,
                        $season->tournament->category_id,
                        $season->tournament_id
                    );
                    $awayTeam->save();
                }

                if (empty($tournamentSeasonGroup)) {
                    $tournamentSeasonGroup = TournamentSeasonGroupFactory::buildFromTournamentGroup(
                        $event->tournament,
                        $tournament->id,
                        $season->id
                    );
                    $tournamentSeasonGroup->save();
                }

                $eventForSave[] = TournamentSeasonNextEventFactory::buildArrayFromNextEvent(
                    $event,
                    $season,
                    $tournamentSeasonGroup->id,
                    $homeTeam,
                    $awayTeam,
                    $eventExist
                );
            }

            if (! empty($eventForSave)) {
                if ($this->overwrite) {
                    TournamentSeasonNextEvent::query()->updateOrInsert($eventForSave);
                } else {
                    TournamentSeasonNextEvent::query()->insert($eventForSave);
                }

                $this->writeLog(count($eventForSave).' Events saved for tournament season '.$data->uniqueTournamentSeason->id, true);
            } else {
                $this->writeLog('No events found for tournament season '.$data->uniqueTournamentSeason->id, true);
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $this->writeLog('Error while processing tournament season next events: '.$e->getMessage().$e->getTraceAsString(), true);
        }
    }

    public function setDebug(bool $debug): void
    {
        $this->debug = $debug;
    }

    public function setOverwrite(bool $overwrite): void
    {
        $this->overwrite = $overwrite;
    }

    private function writeLog(string|array $message, bool $force = false): void
    {
        if ($this->debug || $force) {
            print_r($message);
            print_r(PHP_EOL);
        }
    }
}
