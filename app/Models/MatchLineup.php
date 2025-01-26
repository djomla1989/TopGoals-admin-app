<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $match_id
 * @property int $team_id
 * @property string|null $formation
 * @property string|null $jersey_primary
 * @property string|null $number
 * @property string|null $jersey_outline
 * @property string|null $fancy_number
 * @property string|null $goalkeeper_jersey_primary
 * @property string|null $goalkeeper_number
 * @property string|null $goalkeeper_jersey_outline
 * @property string|null $goalkeeper_fancy_number
 * @property \DateTime $created_at
 * @property \DateTime $updated_at
 * @property MatchEvent $match
 * @property Team $team
 */
class MatchLineup extends BaseModel
{
    protected $fillable = [
        'match_id',
        'team_id',
        'formation',
        'jersey_primary',
        'number',
        'jersey_outline',
        'fancy_number',
        'goalkeeper_jersey_primary',
        'goalkeeper_number',
        'goalkeeper_jersey_outline',
        'goalkeeper_fancy_number',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchEvent::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function setMatch(MatchEvent $match): self
    {
        $this->match()->associate($match);
        return $this;
    }

    public function setTeam(Team $team): self
    {
        $this->team()->associate($team);
        return $this;
    }

    public function setFormation(?string $formation): self
    {
        $this->formation = $formation;
        return $this;
    }

    public function setJerseyPrimary(?string $jerseyPrimary): self
    {
        $this->jersey_primary = $jerseyPrimary;
        return $this;
    }

    public function setNumber(?string $number): self
    {
        $this->number = $number;
        return $this;
    }

    public function setJerseyOutline(?string $jerseyOutline): self
    {
        $this->jersey_outline = $jerseyOutline;
        return $this;
    }

    public function setFancyNumber(?string $fancyNumber): self
    {
        $this->fancy_number = $fancyNumber;
        return $this;
    }

    public function setGoalkeeperJerseyPrimary(?string $goalkeeperJerseyPrimary): self
    {
        $this->goalkeeper_jersey_primary = $goalkeeperJerseyPrimary;
        return $this;
    }

    public function setGoalkeeperNumber(?string $goalkeeperNumber): self
    {
        $this->goalkeeper_number = $goalkeeperNumber;
        return $this;
    }

    public function setGoalkeeperJerseyOutline(?string $goalkeeperJerseyOutline): self
    {
        $this->goalkeeper_jersey_outline = $goalkeeperJerseyOutline;
        return $this;
    }

    public function setGoalkeeperFancyNumber(?string $goalkeeperFancyNumber): self
    {
        $this->goalkeeper_fancy_number = $goalkeeperFancyNumber;
        return $this;
    }
}
