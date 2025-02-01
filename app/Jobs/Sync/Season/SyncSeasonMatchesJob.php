<?php

namespace App\Jobs\Sync\Season;

use App\Builder\Match\MatchAdditionalDataBuilder;
use App\Builder\Match\MatchBuilder;
use App\Builder\Season\SeasonTeamBuilder;
use App\Builder\Team\TeamBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSeasonMatchesJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    const COURSE_EVENTS_LAST = 'last';
    const COURSE_EVENTS_NEXT = 'next';

    use Queueable;

    private Season $season;

    private int $page;

    private string $courseEvents;

    /**
     * Create a new job instance.
     */
    public function __construct(Season $season, int $page = 0, $courseEvents = 'last')
    {
        $this->season = $season;
        $this->page = $page;
        $this->courseEvents = $courseEvents;
        $this->model = $season;
    }

    public function uniqueId(): string
    {
        return get_class($this->season) . '-matches-' . $this->season->id . '-' . $this->page . '-' . $this->courseEvents;
    }

    public function failed(\Throwable $exception): void
    {
        info('Season match data sync failed', [
            'season' => $this->season->id,
            'exception' => $exception->getMessage()
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if (false === config('sync.syncInactive') && $this->season->getIsActive() === false) {
                info('Season is inactive', ['season' => $this->season->id]);
                return;
            }

            $sync = Carbon::now()->subDay();
            $lastSync = $this->season->getLastSync();

            if (!empty($lastSync) && $sync->lessThan($lastSync)) {
                info('Season last sync is less than a day', ['season' => $this->season->id]);
                return;
            }

            $url = $this->getUrl($this->page, $this->courseEvents);
            //$data = $this->getData($url);
            $data =  $this->getExampleData();
            $data = $data['data'] ?? [];

            if (empty($data) || empty($data['events'])) {
                info('Season last events is empty', ['season' => $this->season->id]);
                return;
            }

            $nextPage = $data['hasNextPage'] ?? false;
            foreach ($data['events'] as $event) {
                $this->createMatch($event);
            }

            if ($nextPage) {
                $this->page++;
                SyncSeasonMatchesJob::dispatch($this->season, $this->page, $this->courseEvents)->onQueue('default');
            }
        } catch (\Throwable $th) {
            info('Error in creating match', [
                'season' => $this->season->id,
                'message' => $th->getMessage() ."::". $th->getLine() ."::". $th->getFile()
            ]);
        }

        return;
    }

    private function createMatch(array $data): void
    {
        if (empty($data['homeTeam']) || empty($data['awayTeam'])) {
            return;
        }
        $sport = $this->season->tournament->sport;

        $homeTeam = TeamBuilder::build($data['homeTeam'], $sport);
        $homeTeam->save();

        $awayTeam = TeamBuilder::build($data['awayTeam'], $sport);
        $awayTeam->save();

        $seasonAwayTeam = SeasonTeamBuilder::build($this->season, $awayTeam);
        $seasonAwayTeam->save();

        $seasonHomeTeam = SeasonTeamBuilder::build($this->season, $homeTeam);
        $seasonHomeTeam->save();

        $match = MatchBuilder::buildFromEvent($data, $this->season, $homeTeam, $awayTeam);
        $match->save();

        $matchAdditionalData = MatchAdditionalDataBuilder::buildFromEvent($data, $match);
        $matchAdditionalData->save();
    }

    private function getUrl(int $page, string $courseEvents): string
    {
        return sprintf(
            'seasons/events?page=%d&seasons_id=%d&unique_tournament_id=%d&course_events=%s',
            $page,
            $this->season->getSourceId(),
            $this->season->tournament->getSourceId(),
            $courseEvents
        );
    }

    private function getExampleData(): array
    {
        $jayParsedAry = [
            "data" => [
                "events" => [
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "rY",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2817912,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 452626,
                            "nameCode" => "EVE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#274488",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إيفرتون",
                                    "ru" => "Эвертон",
                                    "hi" => "एवर्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إيفرتون",
                                    "hi" => "एवर्टन"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 6,
                            "currentPeriodStartTimestamp" => 1735219997
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735223083
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436481,
                        "startTimestamp" => 1735216200,
                        "slug" => "everton-manchester-city",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "hkb",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Bournemouth",
                            "slug" => "bournemouth",
                            "shortName" => "Bournemouth",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 283917,
                            "nameCode" => "BOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 60,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بورنموث",
                                    "ru" => "Борнмут",
                                    "hi" => "बोर्नमाउथ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بورنموث",
                                    "hi" => "बोर्नमाउथ"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 397136,
                            "nameCode" => "CRY",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0033ff",
                                "secondary" => "#b90d2b",
                                "text" => "#b90d2b"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "ru" => "Кристал Пэлас",
                                    "hi" => "क्रिस्टल पैलेस"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "hi" => "क्रिस्टल पैलेस"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 3,
                            "currentPeriodStartTimestamp" => 1735228891
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735231832
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436476,
                        "startTimestamp" => 1735225200,
                        "slug" => "bournemouth-crystal-palace",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "MV",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 210147,
                            "nameCode" => "SOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ساوثهامبتون",
                                    "ru" => "Саутгемптон",
                                    "hi" => "साउथेम्प्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ساوثهامبتون",
                                    "hi" => "साउथेम्प्टन"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 663385,
                            "nameCode" => "WHU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#66192c",
                                "secondary" => "#59b3e4",
                                "text" => "#59b3e4"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "وست هام يونايتد",
                                    "ru" => "Вест Хэм Юнайтед",
                                    "hi" => "वेस्ट हैम यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "وست هام",
                                    "hi" => "वेस्ट हैम"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 0,
                            "period2" => 1,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 10,
                            "injuryTime2" => 7,
                            "currentPeriodStartTimestamp" => 1735229528
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735232687
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436480,
                        "startTimestamp" => 1735225200,
                        "slug" => "southampton-west-ham-united",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "OP",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 878731,
                            "nameCode" => "NEW",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نيوكاسل يونايتد",
                                    "ru" => "Ньюкасл Юнайтед",
                                    "hi" => "न्यूकैसल यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نيوكاسل",
                                    "hi" => "न्यूकैसल"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 846703,
                            "nameCode" => "AVL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#670e36",
                                "secondary" => "#94bee5",
                                "text" => "#94bee5"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أستون فيلا",
                                    "ru" => "Астон Вилла",
                                    "hi" => "एस्टन विला"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أستون فيلا",
                                    "hi" => "एस्टन विला"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 3,
                            "display" => 3,
                            "period1" => 1,
                            "period2" => 2,
                            "normaltime" => 3
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 4,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735229107
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type",
                                "homeScore.period2",
                                "homeScore.normaltime"
                            ],
                            "changeTimestamp" => 1735232121
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436477,
                        "awayRedCards" => 1,
                        "startTimestamp" => 1735225200,
                        "slug" => "aston-villa-newcastle-united",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "osI",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Nottingham Forest",
                            "slug" => "nottingham-forest",
                            "shortName" => "Forest",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 318364,
                            "nameCode" => "NFO",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 14,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نوتنغهام فورست",
                                    "ru" => "Ноттингем Форест",
                                    "hi" => "नॉटिंघम फॉरेस्ट"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فورست",
                                    "hi" => "फॉरेस्ट"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham ",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 1297172,
                            "nameCode" => "TOT",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000066",
                                "text" => "#000066"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "توتنهام هوتسبر",
                                    "ru" => "Тоттенхэм Хотспур",
                                    "hi" => "टॉटनहैम हॉटस्पर"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "توتنهام",
                                    "hi" => "टॉटनहैम"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735228933
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735231992
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436479,
                        "awayRedCards" => 1,
                        "startTimestamp" => 1735225200,
                        "slug" => "tottenham-hotspur-nottingham-forest",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "NsT",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2080321,
                            "nameCode" => "CHE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0310a7",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "ru" => "Челси",
                                    "hi" => "चेल्सी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "hi" => "चेल्सी"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Fulham",
                            "slug" => "fulham",
                            "shortName" => "Fulham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 399308,
                            "nameCode" => "FUL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 43,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "فولهام",
                                    "ru" => "Фулхэм",
                                    "hi" => "फुलहम"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فولهام",
                                    "hi" => "फुलहम"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 6,
                            "currentPeriodStartTimestamp" => 1735228975
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735232178
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436473,
                        "startTimestamp" => 1735225200,
                        "slug" => "fulham-chelsea",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "dsK",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolves",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 405528,
                            "nameCode" => "WOL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff9900",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ولفرهامبتون",
                                    "ru" => "Вулверхэмптон Уондерерс",
                                    "hi" => "वॉल्वरहैम्प्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "وولفز",
                                    "hi" => "वॉल्व्स"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Man Utd",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2529344,
                            "nameCode" => "MUN",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#373737",
                                "text" => "#373737"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر يونايتد",
                                    "ru" => "Манчестер Юнайтед",
                                    "hi" => "मैनचेस्टर यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان يونايتد",
                                    "hi" => "मैन यूनाइटेड"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 8,
                            "currentPeriodStartTimestamp" => 1735237890
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type",
                                "homeScore.period2",
                                "homeScore.normaltime"
                            ],
                            "changeTimestamp" => 1735241175
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436482,
                        "awayRedCards" => 1,
                        "startTimestamp" => 1735234200,
                        "slug" => "manchester-united-wolverhampton",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "GU",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2523156,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 526459,
                            "nameCode" => "LEI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#003090",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليستر سيتي",
                                    "ru" => "Лестер Сити",
                                    "hi" => "लीसेस्टर सिटी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليستر",
                                    "hi" => "लीसेस्टर"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 3,
                            "display" => 3,
                            "period1" => 1,
                            "period2" => 2,
                            "normaltime" => 3
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 2,
                            "injuryTime2" => 9,
                            "currentPeriodStartTimestamp" => 1735247013
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735250264
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436474,
                        "startTimestamp" => 1735243200,
                        "slug" => "liverpool-leicester-city",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "Fsab",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 610188,
                            "nameCode" => "BHA",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0054a6",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برايتون وهوف ألبيون",
                                    "ru" => "Брайтон энд Хоув Альбион",
                                    "hi" => "ब्राइटन एंड होव एल्बियन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برايتون",
                                    "hi" => "ब्राइटन"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 359250,
                            "nameCode" => "BRE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#ff0000",
                                "text" => "#ff0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "ru" => "Брентфорд",
                                    "hi" => "ब्रेंटफोर्ड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "hi" => "ब्रेंटफोर्ड"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 5,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735331807
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735334836
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436475,
                        "startTimestamp" => 1735327800,
                        "slug" => "brentford-brighton-and-hove-albion",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 18
                        ],
                        "customId" => "HsR",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2282382,
                            "nameCode" => "ARS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ارسنال",
                                    "ru" => "Арсенал",
                                    "hi" => "आर्सेनल"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ارسنال",
                                    "hi" => "आर्सेनल"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Ipswich Town",
                            "slug" => "ipswich-town",
                            "shortName" => "Ipswich",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 144786,
                            "nameCode" => "IPS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 32,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0000ff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ايبسويتش تاون",
                                    "ru" => "Ипсвич Таун"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 4,
                            "currentPeriodStartTimestamp" => 1735334227
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735337210
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436472,
                        "startTimestamp" => 1735330500,
                        "slug" => "arsenal-ipswich-town",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "rG",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 526459,
                            "nameCode" => "LEI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#003090",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليستر سيتي",
                                    "ru" => "Лестер Сити",
                                    "hi" => "लीसेस्टर सिटी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليستر",
                                    "hi" => "लीसेस्टर"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2817912,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735486331
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735489362
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436512,
                        "startTimestamp" => 1735482600,
                        "slug" => "leicester-city-manchester-city",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "hV",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 397136,
                            "nameCode" => "CRY",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0033ff",
                                "secondary" => "#b90d2b",
                                "text" => "#b90d2b"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "ru" => "Кристал Пэлас",
                                    "hi" => "क्रिस्टल पैलेस"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "hi" => "क्रिस्टल पैलेस"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 210147,
                            "nameCode" => "SOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ساوثهامبتون",
                                    "ru" => "Саутгемптон",
                                    "hi" => "साउथेम्प्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ساوثهامبتون",
                                    "hi" => "साउथेम्प्टन"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 2,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735488178
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735491250
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436532,
                        "startTimestamp" => 1735484400,
                        "slug" => "southampton-crystal-palace",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "Tskb",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Fulham",
                            "slug" => "fulham",
                            "shortName" => "Fulham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 399308,
                            "nameCode" => "FUL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 43,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "فولهام",
                                    "ru" => "Фулхэм",
                                    "hi" => "फुलहम"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فولهام",
                                    "hi" => "फुलहम"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Bournemouth",
                            "slug" => "bournemouth",
                            "shortName" => "Bournemouth",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 283917,
                            "nameCode" => "BOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 60,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بورنموث",
                                    "ru" => "Борнмут",
                                    "hi" => "बोर्नमाउथ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بورنموث",
                                    "hi" => "बोर्नमाउथ"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 3,
                            "injuryTime2" => 6,
                            "currentPeriodStartTimestamp" => 1735488327
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735491547
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436515,
                        "startTimestamp" => 1735484400,
                        "slug" => "bournemouth-fulham",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "osY",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 452626,
                            "nameCode" => "EVE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#274488",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إيفرتون",
                                    "ru" => "Эвертон",
                                    "hi" => "एवर्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إيفرتون",
                                    "hi" => "एवर्टन"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Nottingham Forest",
                            "slug" => "nottingham-forest",
                            "shortName" => "Forest",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 318364,
                            "nameCode" => "NFO",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 14,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نوتنغهام فورست",
                                    "ru" => "Ноттингем Форест",
                                    "hi" => "नॉटिंघम फॉरेस्ट"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فورست",
                                    "hi" => "फॉरेस्ट"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 2,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735488306
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735491326
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436517,
                        "startTimestamp" => 1735484400,
                        "slug" => "everton-nottingham-forest",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "dsI",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham ",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 1297172,
                            "nameCode" => "TOT",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000066",
                                "text" => "#000066"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "توتنهام هوتسبر",
                                    "ru" => "Тоттенхэм Хотспур",
                                    "hi" => "टॉटनहैम हॉटस्पर"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "توتنهام",
                                    "hi" => "टॉटनहैम"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolves",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 405528,
                            "nameCode" => "WOL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff9900",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ولفرهامبتون",
                                    "ru" => "Вулверхэмптон Уондерерс",
                                    "hi" => "वॉल्वरहैम्प्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "وولفز",
                                    "hi" => "वॉल्व्स"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 2,
                            "period2" => 0,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 3,
                            "injuryTime2" => 8,
                            "currentPeriodStartTimestamp" => 1735488338
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735491715
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436521,
                        "startTimestamp" => 1735484400,
                        "slug" => "tottenham-hotspur-wolverhampton",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "MU",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 663385,
                            "nameCode" => "WHU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#66192c",
                                "secondary" => "#59b3e4",
                                "text" => "#59b3e4"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "وست هام يونايتد",
                                    "ru" => "Вест Хэм Юнайтед",
                                    "hi" => "वेस्ट हैम यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "وست هام",
                                    "hi" => "वेस्ट हैम"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2523156,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 5,
                            "display" => 5,
                            "period1" => 3,
                            "period2" => 2,
                            "normaltime" => 5
                        ],
                        "time" => [
                            "injuryTime1" => 3,
                            "injuryTime2" => 4,
                            "currentPeriodStartTimestamp" => 1735496390
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735499375
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436513,
                        "startTimestamp" => 1735492500,
                        "slug" => "liverpool-west-ham-united",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "FP",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 846703,
                            "nameCode" => "AVL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#670e36",
                                "secondary" => "#94bee5",
                                "text" => "#94bee5"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أستون فيلا",
                                    "ru" => "Астон Вилла",
                                    "hi" => "एस्टन विला"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أستون فيلا",
                                    "hi" => "एस्टन विला"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 610188,
                            "nameCode" => "BHA",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0054a6",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برايتون وهوف ألبيون",
                                    "ru" => "Брайтон энд Хоув Альбион",
                                    "hi" => "ब्राइटन एंड होव एल्बियन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برايتون",
                                    "hi" => "ब्राइटन"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 12,
                            "injuryTime2" => 6,
                            "currentPeriodStartTimestamp" => 1735592374
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735595452
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436530,
                        "startTimestamp" => 1735587900,
                        "slug" => "aston-villa-brighton-and-hove-albion",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "HsN",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Ipswich Town",
                            "slug" => "ipswich-town",
                            "shortName" => "Ipswich",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 144786,
                            "nameCode" => "IPS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 32,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0000ff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ايبسويتش تاون",
                                    "ru" => "Ипсвич Таун"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2080321,
                            "nameCode" => "CHE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0310a7",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "ru" => "Челси",
                                    "hi" => "चेल्सी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "hi" => "चेल्सी"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 5,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1735591925
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735595020
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436510,
                        "startTimestamp" => 1735587900,
                        "slug" => "chelsea-ipswich-town",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "DYBe",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Man Utd",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2529344,
                            "nameCode" => "MUN",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#373737",
                                "text" => "#373737"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر يونايتد",
                                    "ru" => "Манчестер Юнайтед",
                                    "hi" => "मैनचेस्टर यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان يونايتد",
                                    "hi" => "मैन यूनाइटेड"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 878731,
                            "nameCode" => "NEW",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نيوكاسل يونايتد",
                                    "ru" => "Ньюкасл Юнайтед",
                                    "hi" => "न्यूकैसल यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نيوكاسل",
                                    "hi" => "न्यूकैसल"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 2,
                            "period2" => 0,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 3,
                            "injuryTime2" => 3,
                            "currentPeriodStartTimestamp" => 1735592623
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735595527
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436522,
                        "startTimestamp" => 1735588800,
                        "slug" => "newcastle-united-manchester-united",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 19
                        ],
                        "customId" => "Rsab",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 359250,
                            "nameCode" => "BRE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#ff0000",
                                "text" => "#ff0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "ru" => "Брентфорд",
                                    "hi" => "ब्रेंटफोर्ड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "hi" => "ब्रेंटफोर्ड"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2282382,
                            "nameCode" => "ARS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ارسنال",
                                    "ru" => "Арсенал",
                                    "hi" => "आर्सेनल"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ارسنال",
                                    "hi" => "आर्सेनल"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 3,
                            "display" => 3,
                            "period1" => 1,
                            "period2" => 2,
                            "normaltime" => 3
                        ],
                        "time" => [
                            "injuryTime1" => 4,
                            "injuryTime2" => 4,
                            "currentPeriodStartTimestamp" => 1735756542
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1735759514
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436410,
                        "startTimestamp" => 1735752600,
                        "slug" => "brentford-arsenal",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "IO",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham ",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 1297172,
                            "nameCode" => "TOT",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000066",
                                "text" => "#000066"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "توتنهام هوتسبر",
                                    "ru" => "Тоттенхэм Хотспур",
                                    "hi" => "टॉटनहैम हॉटस्पर"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "توتنهام",
                                    "hi" => "टॉटनहैम"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 878731,
                            "nameCode" => "NEW",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نيوكاسل يونايتد",
                                    "ru" => "Ньюкасл Юнайтед",
                                    "hi" => "न्यूकैसल यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نيوكاسل",
                                    "hi" => "न्यूकैसल"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 2,
                            "period2" => 0,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 4,
                            "injuryTime2" => 10,
                            "currentPeriodStartTimestamp" => 1735997705
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736001179
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436519,
                        "startTimestamp" => 1735993800,
                        "slug" => "newcastle-united-tottenham-hotspur",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "Vsab",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 210147,
                            "nameCode" => "SOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ساوثهامبتون",
                                    "ru" => "Саутгемптон",
                                    "hi" => "साउथेम्प्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ساوثهامبتون",
                                    "hi" => "साउथेम्प्टन"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 359250,
                            "nameCode" => "BRE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#ff0000",
                                "text" => "#ff0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "ru" => "Брентфорд",
                                    "hi" => "ब्रेंटफोर्ड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "hi" => "ब्रेंटफोर्ड"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 5,
                            "display" => 5,
                            "period1" => 1,
                            "period2" => 4,
                            "normaltime" => 5
                        ],
                        "time" => [
                            "injuryTime1" => 3,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1736006725
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type",
                                "awayScore.period2",
                                "awayScore.normaltime"
                            ],
                            "changeTimestamp" => 1736009756
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436520,
                        "startTimestamp" => 1736002800,
                        "slug" => "brentford-southampton",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "Yskb",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Bournemouth",
                            "slug" => "bournemouth",
                            "shortName" => "Bournemouth",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 283917,
                            "nameCode" => "BOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 60,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بورنموث",
                                    "ru" => "Борнмут",
                                    "hi" => "बोर्नमाउथ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بورنموث",
                                    "hi" => "बोर्नमाउथ"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 452626,
                            "nameCode" => "EVE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#274488",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إيفرتون",
                                    "ru" => "Эвертон",
                                    "hi" => "एवर्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إيفرتون",
                                    "hi" => "एवर्टन"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 0,
                            "period2" => 1,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "time" => [
                            "injuryTime1" => 5,
                            "injuryTime2" => 3,
                            "currentPeriodStartTimestamp" => 1736006753
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736009647
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436518,
                        "startTimestamp" => 1736002800,
                        "slug" => "bournemouth-everton",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "GP",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 846703,
                            "nameCode" => "AVL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#670e36",
                                "secondary" => "#94bee5",
                                "text" => "#94bee5"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أستون فيلا",
                                    "ru" => "Астон Вилла",
                                    "hi" => "एस्टन विला"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أستون فيلا",
                                    "hi" => "एस्टन विला"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 526459,
                            "nameCode" => "LEI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#003090",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليستر سيتي",
                                    "ru" => "Лестер Сити",
                                    "hi" => "लीसेस्टर सिटी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليستر",
                                    "hi" => "लीसेस्टर"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 0,
                            "period2" => 1,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 3,
                            "injuryTime2" => 5,
                            "currentPeriodStartTimestamp" => 1736006659
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736009713
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436523,
                        "startTimestamp" => 1736002800,
                        "slug" => "aston-villa-leicester-city",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "hN",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 397136,
                            "nameCode" => "CRY",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0033ff",
                                "secondary" => "#b90d2b",
                                "text" => "#b90d2b"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "ru" => "Кристал Пэлас",
                                    "hi" => "क्रिस्टल पैलेस"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "hi" => "क्रिस्टल पैलेस"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2080321,
                            "nameCode" => "CHE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0310a7",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "ru" => "Челси",
                                    "hi" => "चेल्सी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "hi" => "चेल्सी"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 0,
                            "period2" => 1,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 4,
                            "currentPeriodStartTimestamp" => 1736006589
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736009541
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436419,
                        "startTimestamp" => 1736002800,
                        "slug" => "chelsea-crystal-palace",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "rM",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 1,
                        "homeTeam" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2817912,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 663385,
                            "nameCode" => "WHU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#66192c",
                                "secondary" => "#59b3e4",
                                "text" => "#59b3e4"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "وست هام يونايتد",
                                    "ru" => "Вест Хэм Юнайтед",
                                    "hi" => "वेस्ट हैम यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "وست هام",
                                    "hi" => "वेस्ट हैम"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 4,
                            "display" => 4,
                            "period1" => 2,
                            "period2" => 2,
                            "normaltime" => 4
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 0,
                            "period2" => 1,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 6,
                            "currentPeriodStartTimestamp" => 1736006573
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736009658
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436508,
                        "startTimestamp" => 1736002800,
                        "slug" => "west-ham-united-manchester-city",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "FsR",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 610188,
                            "nameCode" => "BHA",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0054a6",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برايتون وهوف ألبيون",
                                    "ru" => "Брайтон энд Хоув Альбион",
                                    "hi" => "ब्राइटन एंड होव एल्बियन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برايتون",
                                    "hi" => "ब्राइटन"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2282382,
                            "nameCode" => "ARS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ارسنال",
                                    "ru" => "Арсенал",
                                    "hi" => "आर्सेनल"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ارسنال",
                                    "hi" => "आर्सेनल"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 0,
                            "period2" => 1,
                            "normaltime" => 1
                        ],
                        "awayScore" => [
                            "current" => 1,
                            "display" => 1,
                            "period1" => 1,
                            "period2" => 0,
                            "normaltime" => 1
                        ],
                        "time" => [
                            "injuryTime1" => 4,
                            "injuryTime2" => 6,
                            "currentPeriodStartTimestamp" => 1736015778
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736018848
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436528,
                        "startTimestamp" => 1736011800,
                        "slug" => "arsenal-brighton-and-hove-albion",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "HsT",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Fulham",
                            "slug" => "fulham",
                            "shortName" => "Fulham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 399308,
                            "nameCode" => "FUL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 43,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "فولهام",
                                    "ru" => "Фулхэм",
                                    "hi" => "फुलहम"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فولهام",
                                    "hi" => "फुलहम"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Ipswich Town",
                            "slug" => "ipswich-town",
                            "shortName" => "Ipswich",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 144786,
                            "nameCode" => "IPS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 32,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#0000ff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ايبسويتش تاون",
                                    "ru" => "Ипсвич Таун"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 1,
                            "period2" => 1,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 1,
                            "injuryTime2" => 7,
                            "currentPeriodStartTimestamp" => 1736089348
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736092547
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436525,
                        "startTimestamp" => 1736085600,
                        "slug" => "fulham-ipswich-town",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "KU",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 3,
                        "homeTeam" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2523156,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Man Utd",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2529344,
                            "nameCode" => "MUN",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#373737",
                                "text" => "#373737"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر يونايتد",
                                    "ru" => "Манчестер Юнайтед",
                                    "hi" => "मैनचेस्टर यूनाइटेड"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان يونايتد",
                                    "hi" => "मैन यूनाइटेड"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "awayScore" => [
                            "current" => 2,
                            "display" => 2,
                            "period1" => 0,
                            "period2" => 2,
                            "normaltime" => 2
                        ],
                        "time" => [
                            "injuryTime1" => 2,
                            "injuryTime2" => 7,
                            "currentPeriodStartTimestamp" => 1736098455
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type"
                            ],
                            "changeTimestamp" => 1736101594
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436514,
                        "startTimestamp" => 1736094600,
                        "slug" => "liverpool-manchester-united",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ],
                    [
                        "tournament" => [
                            "name" => "Premier League",
                            "slug" => "premier-league",
                            "category" => [
                                "name" => "England",
                                "slug" => "england",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "id" => 1,
                                "country" => [
                                    "alpha2" => "EN",
                                    "alpha3" => "ENG",
                                    "name" => "England",
                                    "slug" => "england"
                                ],
                                "flag" => "england",
                                "alpha2" => "EN"
                            ],
                            "uniqueTournament" => [
                                "name" => "Premier League",
                                "slug" => "premier-league",
                                "primaryColorHex" => "#3c1c5a",
                                "secondaryColorHex" => "#f80158",
                                "category" => [
                                    "name" => "England",
                                    "slug" => "england",
                                    "sport" => [
                                        "name" => "Football",
                                        "slug" => "football",
                                        "id" => 1
                                    ],
                                    "id" => 1,
                                    "country" => [
                                        "alpha2" => "EN",
                                        "alpha3" => "ENG",
                                        "name" => "England",
                                        "slug" => "england"
                                    ],
                                    "flag" => "england",
                                    "alpha2" => "EN"
                                ],
                                "userCount" => 1371867,
                                "hasPerformanceGraphFeature" => true,
                                "id" => 17,
                                "country" => [
                                ],
                                "hasEventPlayerStatistics" => true,
                                "displayInverseHomeAwayTeams" => false,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "priority" => 617,
                            "isGroup" => false,
                            "isLive" => false,
                            "id" => 1,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग"
                                ],
                                "shortNameTranslation" => [
                                ]
                            ]
                        ],
                        "season" => [
                            "name" => "Premier League 24/25",
                            "year" => "24/25",
                            "editor" => false,
                            "id" => 61627
                        ],
                        "roundInfo" => [
                            "round" => 20
                        ],
                        "customId" => "dso",
                        "status" => [
                            "code" => 100,
                            "description" => "Ended",
                            "type" => "finished"
                        ],
                        "winnerCode" => 2,
                        "homeTeam" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolves",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 405528,
                            "nameCode" => "WOL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#ff9900",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ولفرهامبتون",
                                    "ru" => "Вулверхэмптон Уондерерс",
                                    "hi" => "वॉल्वरहैम्प्टन"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "وولفز",
                                    "hi" => "वॉल्व्स"
                                ]
                            ]
                        ],
                        "awayTeam" => [
                            "name" => "Nottingham Forest",
                            "slug" => "nottingham-forest",
                            "shortName" => "Forest",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 318364,
                            "nameCode" => "NFO",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 14,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "entityType" => "team",
                            "subTeams" => [
                            ],
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نوتنغهام فورست",
                                    "ru" => "Ноттингем Форест",
                                    "hi" => "नॉटिंघम फॉरेस्ट"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فورست",
                                    "hi" => "फॉरेस्ट"
                                ]
                            ]
                        ],
                        "homeScore" => [
                            "current" => 0,
                            "display" => 0,
                            "period1" => 0,
                            "period2" => 0,
                            "normaltime" => 0
                        ],
                        "awayScore" => [
                            "current" => 3,
                            "display" => 3,
                            "period1" => 2,
                            "period2" => 1,
                            "normaltime" => 3
                        ],
                        "time" => [
                            "injuryTime1" => 2,
                            "injuryTime2" => 4,
                            "currentPeriodStartTimestamp" => 1736197371
                        ],
                        "changes" => [
                            "changes" => [
                                "status.code",
                                "status.description",
                                "status.type",
                                "awayScore.period2",
                                "awayScore.normaltime"
                            ],
                            "changeTimestamp" => 1736200392
                        ],
                        "hasGlobalHighlights" => true,
                        "hasXg" => true,
                        "hasEventPlayerStatistics" => true,
                        "hasEventPlayerHeatMap" => true,
                        "detailId" => 1,
                        "crowdsourcingDataDisplayEnabled" => false,
                        "id" => 12436437,
                        "startTimestamp" => 1736193600,
                        "slug" => "nottingham-forest-wolverhampton",
                        "finalResultOnly" => false,
                        "feedLocked" => true,
                        "isEditor" => false
                    ]
                ],
                "hasNextPage" => true
            ]
        ];

        return $jayParsedAry;
    }
}
