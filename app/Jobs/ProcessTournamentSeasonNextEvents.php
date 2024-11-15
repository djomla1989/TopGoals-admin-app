<?php

namespace App\Jobs;

use App\Models\Country;
use App\Models\Sport;
use App\Models\Team;
use App\Models\Tournament;
use App\Models\TournamentSeason;
use App\Models\TournamentSeasonNextEvent;
use Database\Factories\CountryFactory;
use Database\Factories\TeamFactory;
use Database\Factories\TournamentFactory;
use Database\Factories\TournamentSeasonFactory;
use Database\Factories\TournamentSeasonNextEventFactory;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;

class ProcessTournamentSeasonNextEvents implements ShouldQueue
{
    use Queueable;

    protected array $data;

    protected bool $debug = false;

    /**
     * Create a new job instance.
     */
    public function __construct(array $tournamentSeasonNextEventsData)
    {
        $this->data = $tournamentSeasonNextEventsData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::beginTransaction();

        $data = json_decode(json_encode($this->data));

        $tournament = Tournament::query()->where('import_id', $data->uniqueTournamentSeason->id)->first();
        $season = TournamentSeason::query()->where('import_id', $data->uniqueTournamentSeason->id)->first();
        $sport = Sport::query()->where('name', Sport::FOOTBALL)->first();

        $firstEvent = $data->events[0];
        if (empty($firstEvent)) {
            $this->writeLog('No events found for tournament season '.$data->uniqueTournamentSeason->id, true);

            return;
        }

        $country = Country::query()->where('import_id', $firstEvent->tournament->category->id)->first();

        if (empty($country)) {
            $country = CountryFactory::buildFromNextEvent($firstEvent);
            $country->save();
        }

        if (empty($tournament)) {
            $this->writeLog('Tournament not found for tournament season : '.$data->uniqueTournamentSeason->id.' try to create ', true);
            $tournament = TournamentFactory::buildFromNextEvent($firstEvent, $sport->id, $country->id);
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
            if (!empty($eventExist)) {
                $this->writeLog('Event already exist:'.$event->id, true);
                continue;
            }

            $homeTeam = Team::query()->where('import_id', $event->homeTeam->id)->first();
            $awayTeam = Team::query()->where('import_id', $event->awayTeam->id)->first();
            if (empty($homeTeam)) {
                $homeTeam = TeamFactory::buildFromNextEventTeam($event->homeTeam, $season);
                $homeTeam->save();
            }

            if (empty($awayTeam)) {
                $awayTeam = TeamFactory::buildFromNextEventTeam($event->awayTeam, $season);
                $awayTeam->save();
            }

            $eventForSave[] = TournamentSeasonNextEventFactory::buildArrayFromNextEvent($event, $season, $homeTeam, $awayTeam);
        }

        //$this->writeLog('data: '.print_r($eventForSave,true), true);
        if (!empty($eventForSave)) {
            TournamentSeasonNextEvent::query()->insert($eventForSave);
            $this->writeLog(count($eventForSave). ' Events saved for tournament season '.$data->uniqueTournamentSeason->id, true);
        } else {
            $this->writeLog('No events found for tournament season '.$data->uniqueTournamentSeason->id, true);
        }

        DB::commit();
    }

    public function uniqueId(): string
    {
        return $this->data['uniqueTournamentSeason']['id'];
    }

    private function writeLog(string|array $message, bool $force = false): void
    {
        if ($this->debug || $force) {
            print_r($message);
            print_r(PHP_EOL);
        }
    }
}
