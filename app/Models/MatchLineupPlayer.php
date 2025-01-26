<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $match_lineup_id
 * @property int $player_id
 * @property string $position
 * @property int|null $jersey_number
 * @property bool $is_captain
 * @property bool $is_substitute
 * @property bool $is_missing
 * @property string|null $missing_reason
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property MatchLineup $matchLineup
 * @property Player $player
 */
class MatchLineupPlayer extends Model
{
    protected $fillable = [
        'match_lineup_id',
        'player_id',
        'position',
        'jersey_number',
        'is_captain',
        'is_substitute',
        'is_missing',
        'missing_reason',
    ];

    public function matchLineup(): BelongsTo
    {
        return $this->belongsTo(MatchLineup::class);
    }

    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }

    public function setMatchLineup(MatchLineup $matchLineup): self
    {
        $this->matchLineup()->associate($matchLineup);
        return $this;
    }

    public function setPlayer(Player $player): self
    {
        $this->player()->associate($player);
        return $this;
    }

    public function setPosition(?string $position): self
    {
        $this->position = $position;
        return $this;
    }

    public function setJerseyNumber(?int $jerseyNumber): self
    {
        $this->jersey_number = $jerseyNumber;
        return $this;
    }

    public function setIsCaptain(bool $isCaptain): self
    {
        $this->is_captain = $isCaptain;
        return $this;
    }

    public function setIsSubstitute(bool $isSubstitute): self
    {
        $this->is_substitute = $isSubstitute;
        return $this;
    }

    public function setIsMissing(bool $isMissing): self
    {
        $this->is_missing = $isMissing;
        return $this;
    }

    public function setMissingReason(?string $missingReason): self
    {
        $this->missing_reason = $missingReason;
        return $this;
    }
}
