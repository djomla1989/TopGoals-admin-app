<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class SeasonStatistic
 * @package App\Models
 *
 * @property int $id
 * @property int $season_id
 * @property int $tournament_id
 * @property int $goals
 * @property int $home_team_wins
 * @property int $away_team_wins
 * @property int $draws
 * @property int $yellow_cards
 * @property int $red_cards
 * @property int $number_of_rounds
 * @property int $number_of_competitors
 * @property \DateTime $last_sync
 * @property Season $season
 * @property Tournament $tournament
 */
class SeasonStatistic extends BaseModel implements LastSyncInterface
{
    protected $table = 'season_statistics';

    protected $fillable = [
        'season_id',
        'tournament_id',
        'goals',
        'home_team_wins',
        'away_team_wins',
        'draws',
        'yellow_cards',
        'red_cards',
        'number_of_rounds',
        'number_of_competitors',
        'last_sync',
    ];

    protected $casts = [
        'last_sync' => 'datetime',
    ];

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function setSeason(Season $season): self
    {
        $this->season()->associate($season);
        return $this;
    }

    public function setTournament(Tournament $tournament): self
    {
        $this->tournament()->associate($tournament);
        return $this;
    }

    public function setGoals(int $goals): self
    {
        $this->goals = $goals;
        return $this;
    }

    public function setHomeTeamWins(int $homeTeamWins): self
    {
        $this->home_team_wins = $homeTeamWins;
        return $this;
    }

    public function setAwayTeamWins(int $awayTeamWins): self
    {
        $this->away_team_wins = $awayTeamWins;
        return $this;
    }

    public function setDraws(int $draws): self
    {
        $this->draws = $draws;
        return $this;
    }

    public function setYellowCards(int $yellowCards): self
    {
        $this->yellow_cards = $yellowCards;
        return $this;
    }

    public function setRedCards(int $redCards): self
    {
        $this->red_cards = $redCards;
        return $this;
    }

    public function setNumberOfRounds(int $numberOfRounds): self
    {
        $this->number_of_rounds = $numberOfRounds;
        return $this;
    }

    public function setNumberOfCompetitors(int $numberOfCompetitors): self
    {
        $this->number_of_competitors = $numberOfCompetitors;
        return $this;
    }

    public function getLastSync(): \DateTime
    {
        return $this->last_sync;
    }
}
