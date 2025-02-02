<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $tournament_id
 * @property bool $has_performance_graph_feature
 * @property int $most_titles
 * @property int $title_holder_id
 * @property string $primary_color_hex
 * @property string $secondary_color_hex
 * @property Tournament $tournament
 */
class TournamentAdditionalData extends BaseModel
{
    protected $table = 'tournament_additional_data';

    protected $fillable = [
        'tournament_id',
        'has_performance_graph_feature',
        'most_titles',
        'title_holder_id',
        'primary_color_hex',
        'secondary_color_hex',
    ];

    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    public function titleHolder(): BelongsTo
    {
        return $this->belongsTo(Team::class, 'title_holder_id');
    }

    public function setTournament(Tournament $tournament): self
    {
        $this->tournament()->associate($tournament);
        return $this;
    }

    public function setTitleHolder(Team $team): self
    {
        $this->titleHolder()->associate($team);
        return $this;
    }

    public function getTournamentId(): int
    {
        return $this->tournament_id;
    }

    public function setHasPerformanceGraphFeature(bool $hasPerformanceGraphFeature): self
    {
        $this->has_performance_graph_feature = $hasPerformanceGraphFeature;
        return $this;
    }

    public function setMostTitles(int $mostTitles): self
    {
        $this->most_titles = $mostTitles;
        return $this;
    }

    public function setPrimaryColorHex(string $primaryColorHex): self
    {
        $this->primary_color_hex = $primaryColorHex;
        return $this;
    }

    public function setSecondaryColorHex(string $secondaryColorHex): self
    {
        $this->secondary_color_hex = $secondaryColorHex;
        return $this;
    }
}

