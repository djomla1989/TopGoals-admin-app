<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $match_id
 * @property bool $has_global_highlights
 * @property bool $has_xg
 * @property bool $has_event_player_statistics
 * @property bool $has_event_player_heatmap
 * @property int $winner_code
 * @property int $injury_time1
 * @property int $injury_time2
 * @property int $home_score_period1
 * @property int $home_score_period2
 * @property int $home_score_normal_time
 * @property int $away_score_period1
 * @property int $away_score_period2
 * @property int $away_score_normal_time
 * @property MatchEvent $match
 */
class MatchAdditionalData extends BaseModel
{
    protected $table = 'match_additional_data';

    protected $fillable = [
        'match_id',
        'has_global_highlights',
        'has_xg',
        'has_event_player_statistics',
        'has_event_player_heatmap',
        'winner_code',
        'injury_time1',
        'injury_time2',
        'home_score_period1',
        'home_score_period2',
        'home_score_normal_time',
        'away_score_period1',
        'away_score_period2',
        'away_score_normal_time',
    ];

    public function match(): BelongsTo
    {
        return $this->belongsTo(MatchEvent::class);
    }

    public function setMatch(MatchEvent $match): self
    {
        $this->match()->associate($match);
        return $this;
    }

    public function getMatchId(): int
    {
        return $this->match_id;
    }

    public function getHasGlobalHighlights(): bool
    {
        return $this->has_global_highlights;
    }

    public function getHasXg(): bool
    {
        return $this->has_xg;
    }

    public function getHasEventPlayerStatistics(): bool
    {
        return $this->has_event_player_statistics;
    }

    public function getHasEventPlayerHeatMap(): bool
    {
        return $this->has_event_player_heatmap;
    }

    public function setMatchId(int $matchId): self
    {
        $this->match_id = $matchId;
        return $this;
    }

    public function setHasGlobalHighlights(?bool $hasGlobalHighlights): self
    {
        $this->has_global_highlights = $hasGlobalHighlights;
        return $this;
    }

    public function setHasXg(?bool $hasXg): self
    {
        $this->has_xg = $hasXg;
        return $this;
    }

    public function setHasEventPlayerStatistics(?bool $hasEventPlayerStatistics): self
    {
        $this->has_event_player_statistics = $hasEventPlayerStatistics;
        return $this;
    }

    public function setHasEventPlayerHeatMap(?bool $hasEventPlayerHeatMap): self
    {
        $this->has_event_player_heatmap = $hasEventPlayerHeatMap;
        return $this;
    }

    public function getWinnerCode(): ?int
    {
        return $this->winner_code;
    }

    public function setWinnerCode(?int $winnerCode): self
    {
        $this->winner_code = $winnerCode;
        return $this;
    }

    public function getInjuryTime1(): ?int
    {
        return $this->injury_time1;
    }

    public function setInjuryTime1(?int $injuryTime1): self
    {
        $this->injury_time1 = $injuryTime1;
        return $this;
    }

    public function getInjuryTime2(): ?int
    {
        return $this->injury_time2;
    }

    public function setInjuryTime2(?int $injuryTime2): self
    {
        $this->injury_time2 = $injuryTime2;
        return $this;
    }

    public function getHomeScorePeriod1(): int
    {
        return $this->home_score_period1;
    }

    public function setHomeScorePeriod1(?int $homeScorePeriod1): self
    {
        $this->home_score_period1 = $homeScorePeriod1;
        return $this;
    }

    public function getHomeScorePeriod2(): int
    {
        return $this->home_score_period2;
    }

    public function setHomeScorePeriod2(?int $homeScorePeriod2): self
    {
        $this->home_score_period2 = $homeScorePeriod2;
        return $this;
    }

    public function getAwayScorePeriod1(): int
    {
        return $this->away_score_period1;
    }

    public function setAwayScorePeriod1(?int $awayScorePeriod1): self
    {
        $this->away_score_period1 = $awayScorePeriod1;
        return $this;
    }

    public function getAwayScorePeriod2(): int
    {
        return $this->away_score_period2;
    }

    public function setAwayScorePeriod2(?int $awayScorePeriod2): self
    {
        $this->away_score_period2 = $awayScorePeriod2;
        return $this;
    }

    public function getHomeScoreNormalTime(): int
    {
        return $this->home_score_normal_time;
    }

    public function setHomeScoreNormalTime(?int $homeScoreNormalTime): self
    {
        $this->home_score_normal_time = $homeScoreNormalTime;
        return $this;
    }

    public function getAwayScoreNormalTime(): int
    {
        return $this->away_score_normal_time;
    }

    public function setAwayScoreNormalTime(?int $awayScoreNormalTime): self
    {
        $this->away_score_normal_time = $awayScoreNormalTime;
        return $this;
    }
}
