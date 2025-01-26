<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

/**
 * @property int $id
 * @property int $source_id
 * @property string $custom_match_id
 * @property int $sport_id
 * @property int $season_id
 * @property int $home_team_id
 * @property int $away_team_id
 * @property string $slug
 * @property string|null $round_type
 * @property string|null $round_name
 * @property int|null $round_number
 * @property \DateTime $start_date
 * @property string $status
 * @property int|null $home_score
 * @property int|null $away_score
 * @property int|null $winner_id
 * @property int|null $referee_id
 * @property int|null $venue_id
 * @property \DateTime|null $last_sync
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property Sport $sport
 * @property Season $season
 * @property Tournament $tournament
 * @property Team $homeTeam
 * @property Team $awayTeam
 * @property Team|null $winner
 * @property Referee|null $referee
 * @property Venue|null $venue
 * @property MatchAdditionalData $additionalData
 */
class MatchEvent extends BaseModel
{
    public $table = 'matches';

    protected $fillable = [
        'source_id',
        'custom_match_id',
        'sport_id',
        'season_id',
        'home_team_id',
        'away_team_id',
        'slug',
        'round_type',
        'round_name',
        'round_number',
        'start_date',
        'status',
        'home_score',
        'away_score',
        'winner_id',
        'referee_id',
        'venue_id',
        'last_sync',
    ];

    protected $casts = [
        'start_date' => 'datetime',
        'last_sync' => 'datetime',
    ];

    public function sport(): BelongsTo
    {
        return $this->belongsTo(Sport::class);
    }

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function tournament(): HasOneThrough
    {
        return $this->hasOneThrough(Tournament::class, Season::class);
    }

    public function homeTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'home_team_id');
    }

    public function awayTeam(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'away_team_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'winner_id');
    }

    public function referee(): BelongsTo
    {
        return $this->belongsTo(Referee::class);
    }

    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    public function additionalData(): HasOne
    {
        return $this->hasOne(MatchAdditionalData::class);
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;
        return $this;
    }

    public function setCustomMatchId(string $customMatchId): self
    {
        $this->custom_match_id = $customMatchId;
        return $this;
    }

    public function setHomeTeam(Team $team): self
    {
        $this->homeTeam()->associate($team);
        return $this;
    }

    public function setAwayTeam(Team $team): self
    {
        $this->awayTeam()->associate($team);
        return $this;
    }

    public function setWinner(Team $team): self
    {
        $this->winner()->associate($team);
        return $this;
    }

    public function setReferee(Referee $referee): self
    {
        $this->referee = $referee;
        return $this;
    }

    public function setVenue(Venue $venue): self
    {
        $this->venue = $venue;
        return $this;
    }

    public function setSeason(Season $season): self
    {
        $this->season()->associate($season);
        return $this;
    }

    public function setRound(?int $round): self
    {
        $this->round_number = $round;
        return $this;
    }

    public function setHomeScore(int $current): self
    {
        $this->home_score = $current;
        return $this;
    }

    public function setAwayScore(int $current): self
    {
        $this->away_score = $current;
        return $this;
    }

    public function setSport(Sport $sport): self
    {
        $this->sport()->associate($sport);
        return $this;
    }

    public function setSlug(mixed $slug): self
    {
        $this->slug = $slug;
        return $this;
    }

    public function setStartDate(?\DateTime $create): self
    {
        $this->start_date = $create;
        return $this;
    }

    public function setStatus(mixed $type): self
    {
        $this->status = $type;
        return $this;
    }

    public function getSourceId(): int
    {
        return $this->source_id;
    }
}
