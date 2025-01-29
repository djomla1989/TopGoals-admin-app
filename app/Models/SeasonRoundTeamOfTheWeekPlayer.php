<?php

namespace App\Models;

use App\Casts\Integer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


/**
 * Class SeasonRoundTeamOfTheWeekPlayer
 * @package App\Models
 *
 * @property int $id
 * @property int $source_id
 * @property int $season_round_team_of_the_week_id
 * @property int $player_id
 * @property string $position
 * @property int $rating
 * @property SeasonRoundTeamOfTheWeek $seasonRoundTeamOfTheWeek
 * @property Player $player
 */
class SeasonRoundTeamOfTheWeekPlayer extends BaseModel
{
    protected $table = 'season_round_team_of_the_week_players';

    protected $fillable = [
        'source_id',
        'season_round_team_of_the_week_id',
        'player_id',
        'position',
        'rating'
    ];

    protected $casts = [
        'rating' => Integer::class
    ];

    public function seasonRoundTeamOfTheWeek(): BelongsTo
    {
        return $this->belongsTo(SeasonRoundTeamOfTheWeek::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function setSourceId(int $sourceId): self
    {
        $this->source_id = $sourceId;
        return $this;
    }

    public function setSeasonRoundTeamOfTheWeek(SeasonRoundTeamOfTheWeek $seasonRoundTeamOfTheWeek): self
    {
        $this->seasonRoundTeamOfTheWeek()->associate($seasonRoundTeamOfTheWeek);
        return $this;
    }

    public function setPlayer(Player $player): self
    {
        $this->player()->associate($player);
        return $this;
    }

    public function setPosition(string $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function setRating(mixed $rating): self
    {
        $this->rating = $rating;
        return $this;
    }
}
