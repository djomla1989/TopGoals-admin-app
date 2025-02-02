<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $tournament_id
 * @property string $type
 * @property int $connected_tournament_id
 * @property Tournament $tournament
 * @property Tournament $connectedTournament
 */
class TournamentConnectedTournament extends BaseModel
{
    protected $table = 'tournament_connected_tournaments';

    protected $fillable = [
        'tournament_id',
        'type',
        'connected_tournament_id',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function connectedTournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class, 'connected_tournament_id');
    }

    public function setTournament(Tournament $tournament): self
    {
        $this->tournament()->associate($tournament);
        return $this;
    }

    public function setConnectedTournament(Tournament $tournament): self
    {
        $this->connectedTournament()->associate($tournament);
        return $this;
    }

    public function setType(string $type): self
    {
        $this->type = $type;
        return $this;
    }
}
