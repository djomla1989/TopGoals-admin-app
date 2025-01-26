<?php

namespace App\Jobs\Sync\Team;

use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use App\Models\Team;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TeamSeasonStatisticJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    const STAT_TYPE_OVERALL = 'overall';
    const STAT_TYPE_REGULAR = 'regularSeason';

    protected Team $team;

    protected Season $season;

    protected string $statType;

    /**
     * Create a new job instance.
     */
    public function __construct(Team $team, Season $season, string $statType = self::STAT_TYPE_OVERALL)
    {
        $this->team = $team;
        $this->season = $season;
        $this->statType = $statType;
    }

    public function uniqueId(): string
    {
        return get_class($this->team) . $this->team->id . get_class($this->season) . $this->season->id . '-team_season_statistic';
    }


    private function getUrl(Team $team, Season $season, Tournament $tournament, string $courseEvents): string
    {
        return 'teams/statistics/result?team_stat_type=' . $courseEvents . '&season_id=' . $season->getSourceId() . '&team_id=' . $team->getSourceId() . '&unique_tournament_id=' . $tournament->getSourceId();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (false === config('sync.syncInactive') && $this->team->getIsActive() === false) {
            info('Team is inactive', ['team' => $this->team->id]);
            return;
        }

        $lastSync = $this->team->getLastSync();

        if (!empty($lastSync) && $this->getLastSyncComparatorDate()->lessThan($lastSync)) {
            info('Team last sync is less than a day', ['team' => $this->team->id]);
            return;
        }
    }

    public function getExampleData()
    {
        $arrayVar = [
            "data" => [
                "goalsScored" => 94,
                "goalsConceded" => 26,
                "ownGoals" => 1,
                "assists" => 71,
                "shots" => 729,
                "penaltyGoals" => 7,
                "penaltiesTaken" => 8,
                "freeKickGoals" => 1,
                "freeKickShots" => 13,
                "goalsFromInsideTheBox" => 86,
                "goalsFromOutsideTheBox" => 8,
                "shotsFromInsideTheBox" => 490,
                "shotsFromOutsideTheBox" => 239,
                "headedGoals" => 16,
                "leftFootGoals" => 39,
                "rightFootGoals" => 39,
                "bigChances" => 132,
                "bigChancesCreated" => 97,
                "bigChancesMissed" => 59,
                "shotsOnTarget" => 256,
                "shotsOffTarget" => 259,
                "blockedScoringAttempt" => 214,
                "successfulDribbles" => 343,
                "dribbleAttempts" => 635,
                "corners" => 282,
                "hitWoodwork" => 9,
                "fastBreaks" => 32,
                "fastBreakGoals" => 4,
                "fastBreakShots" => 29,
                "averageBallPossession" => 63.210526315789,
                "totalPasses" => 23588,
                "accuratePasses" => 20032,
                "accuratePassesPercentage" => 84.924537900627,
                "totalOwnHalfPasses" => 9889,
                "accurateOwnHalfPasses" => 9044,
                "accurateOwnHalfPassesPercentage" => 91.455152189301,
                "totalOppositionHalfPasses" => 14596,
                "accurateOppositionHalfPasses" => 11209,
                "accurateOppositionHalfPassesPercentage" => 76.795012332146,
                "totalLongBalls" => 1782,
                "accurateLongBalls" => 993,
                "accurateLongBallsPercentage" => 55.723905723906,
                "totalCrosses" => 897,
                "accurateCrosses" => 221,
                "accurateCrossesPercentage" => 24.63768115942,
                "cleanSheets" => 21,
                "tackles" => 554,
                "interceptions" => 341,
                "saves" => 82,
                "errorsLeadingToGoal" => 2,
                "errorsLeadingToShot" => 6,
                "penaltiesCommited" => 0,
                "penaltyGoalsConceded" => 0,
                "clearances" => 499,
                "clearancesOffLine" => 4,
                "lastManTackles" => 5,
                "totalDuels" => 3571,
                "duelsWon" => 1755,
                "duelsWonPercentage" => 49.145897507701,
                "totalGroundDuels" => 2525,
                "groundDuelsWon" => 1181,
                "groundDuelsWonPercentage" => 46.772277227723,
                "totalAerialDuels" => 1046,
                "aerialDuelsWon" => 574,
                "aerialDuelsWonPercentage" => 54.875717017208,
                "possessionLost" => 5688,
                "offsides" => 63,
                "fouls" => 363,
                "yellowCards" => 50,
                "yellowRedCards" => 0,
                "redCards" => 1,
                "avgRating" => 7.1622309197652,
                "accurateFinalThirdPassesAgainst" => 1980,
                "accurateOppositionHalfPassesAgainst" => 4062,
                "accurateOwnHalfPassesAgainst" => 6278,
                "accuratePassesAgainst" => 10245,
                "bigChancesAgainst" => 53,
                "bigChancesCreatedAgainst" => 45,
                "bigChancesMissedAgainst" => 39,
                "clearancesAgainst" => 968,
                "cornersAgainst" => 117,
                "crossesSuccessfulAgainst" => 95,
                "crossesTotalAgainst" => 460,
                "dribbleAttemptsTotalAgainst" => 577,
                "dribbleAttemptsWonAgainst" => 343,
                "errorsLeadingToGoalAgainst" => 6,
                "errorsLeadingToShotAgainst" => 12,
                "hitWoodworkAgainst" => 10,
                "interceptionsAgainst" => 487,
                "keyPassesAgainst" => 230,
                "longBallsSuccessfulAgainst" => 958,
                "longBallsTotalAgainst" => 2410,
                "offsidesAgainst" => 144,
                "redCardsAgainst" => 3,
                "shotsAgainst" => 297,
                "shotsBlockedAgainst" => 72,
                "shotsFromInsideTheBoxAgainst" => 196,
                "shotsFromOutsideTheBoxAgainst" => 101,
                "shotsOffTargetAgainst" => 114,
                "shotsOnTargetAgainst" => 111,
                "blockedScoringAttemptAgainst" => 72,
                "tacklesAgainst" => 657,
                "totalFinalThirdPassesAgainst" => 3300,
                "oppositionHalfPassesTotalAgainst" => 6747,
                "ownHalfPassesTotalAgainst" => 7453,
                "totalPassesAgainst" => 13740,
                "yellowCardsAgainst" => 63,
                "id" => 6232,
                "matches" => 38,
                "awardedMatches" => 0,
            ],
        ];

        return $arrayVar;
    }
}
