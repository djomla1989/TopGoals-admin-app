<?php

namespace App\Jobs\Sync\Season;

use App\Builder\Season\SeasonStandingBuilder;
use App\Builder\Season\SeasonStandingGroupBuilder;
use App\Builder\Season\SeasonStandingGroupTeamBuilder;
use App\Builder\Team\TeamBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSeasonStandingJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    const STANDING_TYPE_TOTAL = 'total';
    const STANDING_TYPE_HOME = 'home';
    const STANDING_TYPE_AWAY = 'away';

    private Season $season;

    private string $standingType;

    /**
     * Create a new job instance.
     */
    public function __construct(Season $season, string $standingType = self::STANDING_TYPE_TOTAL)
    {
        $this->season = $season;
        $this->standingType = $standingType;
    }

    public function uniqueId(): string
    {
        return get_class($this->season) . '-standing-' . $this->season->id;
    }

    public function failed(\Throwable $exception): void
    {
        info('Season standing data sync failed', [
            'season' => $this->season->id,
            'exception' => $exception->getMessage()
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        if (false === config('sync.syncInactive') && $this->season->getIsActive() === false) {
            info('Season is inactive', ['season' => $this->season->id]);
            return;
        }

        $lastSync = $this->season->getLastSync();

        if (!empty($lastSync) && $this->getLastSyncComparatorDate()->lessThan($lastSync)) {
            info('Season last sync is less than a day', ['season' => $this->season->id]);
            return;
        }

        $data = $this->getData($this->getUrl($this->season, $this->standingType));
        //$data = $this->getExampleData();

        $data = $data['data'] ?? [];

        if (empty($data) || empty($data[0])) {
            info('Season statistic is empty', ['season' => $this->season->id]);
            return;
        }

        $seasonStanding = SeasonStandingBuilder::build($this->season, $this->standingType);
        $seasonStanding->save();

        foreach ($data as $standingGroup) {
            $seasonStandingGroup = SeasonStandingGroupBuilder::build($seasonStanding, $standingGroup);
            $seasonStandingGroup->save();

            foreach ($standingGroup['rows'] as $standing) {
                $team = TeamBuilder::build($standing['team'], $this->season->tournament->sport);
                $team->save();

                $seasonStandingGroupTeam = SeasonStandingGroupTeamBuilder::build($seasonStandingGroup, $team, $standing);
                $seasonStandingGroupTeam->save();
            }
        }

        info('Season standing data synced', ['season' => $this->season->id]);
    }

    public function getUrl(Season $season, string $standingType): string
    {
        return 'seasons/standings?standing_type=' . $standingType . '&seasons_id=' . $this->season->getSourceId() . '&unique_tournament_id=' . $this->season->tournament->getSourceId();
    }

    public function getExampleData(): array
    {

        $arrayVar = [
            "data" => [
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
                                "id" => 1,
                            ],
                            "id" => 1,
                            "flag" => "england",
                            "alpha2" => "EN",
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
                                    "id" => 1,
                                ],
                                "id" => 1,
                                "flag" => "england",
                                "alpha2" => "EN",
                            ],
                            "userCount" => 1369781,
                            "hasPerformanceGraphFeature" => true,
                            "id" => 17,
                            "displayInverseHomeAwayTeams" => false,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "الدوري الإنجليزي الممتاز",
                                    "hi" => "प्रिमियर लीग",
                                ],
                                "shortNameTranslation" => [],
                            ],
                        ],
                        "priority" => 617,
                        "isGroup" => false,
                        "isLive" => false,
                        "id" => 1,
                        "fieldTranslations" => [
                            "nameTranslation" => [
                                "ar" => "الدوري الإنجليزي الممتاز",
                                "hi" => "प्रिमियर लीग",
                            ],
                            "shortNameTranslation" => [],
                        ],
                    ],
                    "type" => "total",
                    "name" => "Premier League",
                    "descriptions" => [],
                    "tieBreakingRule" => [
                        "text" =>
                            "In the event that two (or more) teams have an equal number of points, the following rules break the tie: 1. Goal difference 2. Goals scored 3. H2H",
                        "id" => 2393,
                    ],
                    "rows" => [
                        [
                            "team" => [
                                "name" => "Liverpool",
                                "slug" => "liverpool",
                                "shortName" => "Liverpool",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 2535975,
                                "nameCode" => "LIV",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 44,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليفربول",
                                        "ru" => "Ливерпуль",
                                        "hi" => "लिवरपूल",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليفربول",
                                        "hi" => "लिवरपूल",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Champions League",
                                "id" => 804
                            ],
                            "position" => 1,
                            "matches" => 19,
                            "wins" => 14,
                            "scoresFor" => 47,
                            "scoresAgainst" => 19,
                            "id" => 1134312,
                            "losses" => 1,
                            "draws" => 4,
                            "points" => 46,
                            "scoreDiffFormatted" => "+28",
                        ],
                        [
                            "team" => [
                                "name" => "Arsenal",
                                "slug" => "arsenal",
                                "shortName" => "Arsenal",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 2295509,
                                "nameCode" => "ARS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 42,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ارسنال",
                                        "ru" => "Арсенал",
                                        "hi" => "आर्सेनल",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ارسنال",
                                        "hi" => "आर्सेनल",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Champions League",
                                "id" => 804
                            ],
                            "position" => 2,
                            "matches" => 20,
                            "wins" => 11,
                            "scoresFor" => 39,
                            "scoresAgainst" => 18,
                            "id" => 1134302,
                            "losses" => 2,
                            "draws" => 7,
                            "points" => 40,
                            "scoreDiffFormatted" => "+21",
                        ],
                        [
                            "team" => [
                                "name" => "Nottingham Forest",
                                "slug" => "nottingham-forest",
                                "shortName" => "Forest",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 322814,
                                "nameCode" => "NFO",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 14,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#cc0000",
                                    "text" => "#cc0000",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "نوتنغهام فورست",
                                        "ru" => "Ноттингем Форест",
                                        "hi" => "नॉटिंघम फॉरेस्ट",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "فورست",
                                        "hi" => "फॉरेस्ट",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Champions League",
                                "id" => 804
                            ],
                            "position" => 3,
                            "matches" => 20,
                            "wins" => 12,
                            "scoresFor" => 29,
                            "scoresAgainst" => 19,
                            "id" => 1134316,
                            "losses" => 4,
                            "draws" => 4,
                            "points" => 40,
                            "scoreDiffFormatted" => "+10",
                        ],
                        [
                            "team" => [
                                "name" => "Chelsea",
                                "slug" => "chelsea",
                                "shortName" => "Chelsea",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 2089891,
                                "nameCode" => "CHE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 38,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0310a7",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "ru" => "Челси",
                                        "hi" => "चेल्सी",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "hi" => "चेल्सी",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Champions League",
                                "id" => 804
                            ],
                            "position" => 4,
                            "matches" => 20,
                            "wins" => 10,
                            "scoresFor" => 39,
                            "scoresAgainst" => 24,
                            "id" => 1134306,
                            "losses" => 4,
                            "draws" => 6,
                            "points" => 36,
                            "scoreDiffFormatted" => "+15",
                        ],
                        [
                            "team" => [
                                "name" => "Newcastle United",
                                "slug" => "newcastle-united",
                                "shortName" => "Newcastle",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 883843,
                                "nameCode" => "NEW",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 39,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "نيوكاسل يونايتد",
                                        "ru" => "Ньюкасл Юнайтед",
                                        "hi" => "न्यूकैसल यूनाइटेड",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "نيوكاسل",
                                        "hi" => "न्यूकैसल",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "UEFA Europa League",
                                "id" => 808,
                            ],
                            "position" => 5,
                            "matches" => 20,
                            "wins" => 10,
                            "scoresFor" => 34,
                            "scoresAgainst" => 22,
                            "id" => 1134315,
                            "losses" => 5,
                            "draws" => 5,
                            "points" => 35,
                            "scoreDiffFormatted" => "+12",
                        ],
                        [
                            "team" => [
                                "name" => "Manchester City",
                                "slug" => "manchester-city",
                                "shortName" => "Man City",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 2829810,
                                "nameCode" => "MCI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 17,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66ccff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر سيتي",
                                        "ru" => "Манчестер Сити",
                                        "hi" => "मैनचेस्टर सिटी",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان سيتي",
                                        "hi" => "मैन सिटी",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 6,
                            "matches" => 20,
                            "wins" => 10,
                            "scoresFor" => 36,
                            "scoresAgainst" => 27,
                            "id" => 1134313,
                            "losses" => 6,
                            "draws" => 4,
                            "points" => 34,
                            "scoreDiffFormatted" => "+9",
                        ],
                        [
                            "team" => [
                                "name" => "Bournemouth",
                                "slug" => "bournemouth",
                                "shortName" => "Bournemouth",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 285654,
                                "nameCode" => "BOU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 60,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#cc0000",
                                    "text" => "#cc0000",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "بورنموث",
                                        "ru" => "Борнмут",
                                        "hi" => "बोर्नमाउथ",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "بورنموث",
                                        "hi" => "बोर्नमाउथ",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 7,
                            "matches" => 20,
                            "wins" => 9,
                            "scoresFor" => 30,
                            "scoresAgainst" => 23,
                            "id" => 1134301,
                            "losses" => 5,
                            "draws" => 6,
                            "points" => 33,
                            "scoreDiffFormatted" => "+7",
                        ],
                        [
                            "team" => [
                                "name" => "Aston Villa",
                                "slug" => "aston-villa",
                                "shortName" => "Aston Villa",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 852429,
                                "nameCode" => "AVL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 40,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#670e36",
                                    "secondary" => "#94bee5",
                                    "text" => "#94bee5",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "أستون فيلا",
                                        "ru" => "Астон Вилла",
                                        "hi" => "एस्टन विला",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "أستون فيلا",
                                        "hi" => "एस्टन विला",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 8,
                            "matches" => 20,
                            "wins" => 9,
                            "scoresFor" => 30,
                            "scoresAgainst" => 32,
                            "id" => 1134303,
                            "losses" => 6,
                            "draws" => 5,
                            "points" => 32,
                            "scoreDiffFormatted" => "-2",
                        ],
                        [
                            "team" => [
                                "name" => "Fulham",
                                "slug" => "fulham",
                                "shortName" => "Fulham",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 402991,
                                "nameCode" => "FUL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 43,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#000000",
                                    "text" => "#000000",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "فولهام",
                                        "ru" => "Фулхэм",
                                        "hi" => "फुलहम",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "فولهام",
                                        "hi" => "फुलहम",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 9,
                            "matches" => 20,
                            "wins" => 7,
                            "scoresFor" => 30,
                            "scoresAgainst" => 27,
                            "id" => 1134309,
                            "losses" => 4,
                            "draws" => 9,
                            "points" => 30,
                            "scoreDiffFormatted" => "+3",
                        ],
                        [
                            "team" => [
                                "name" => "Brighton & Hove Albion",
                                "slug" => "brighton-and-hove-albion",
                                "shortName" => "Brighton",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 611452,
                                "nameCode" => "BHA",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 30,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0054a6",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برايتون وهوف ألبيون",
                                        "ru" => "Брайтон энд Хоув Альбион",
                                        "hi" => "ब्राइटन एंड होव एल्बियन",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برايتون",
                                        "hi" => "ब्राइटन",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 10,
                            "matches" => 20,
                            "wins" => 6,
                            "scoresFor" => 30,
                            "scoresAgainst" => 29,
                            "id" => 1134305,
                            "losses" => 4,
                            "draws" => 10,
                            "points" => 28,
                            "scoreDiffFormatted" => "+1",
                        ],
                        [
                            "team" => [
                                "name" => "Brentford",
                                "slug" => "brentford",
                                "shortName" => "Brentford",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 362383,
                                "nameCode" => "BRE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 50,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#ff0000",
                                    "text" => "#ff0000",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "ru" => "Брентфорд",
                                        "hi" => "ब्रेंटफोर्ड",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "hi" => "ब्रेंटफोर्ड",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 11,
                            "matches" => 20,
                            "wins" => 8,
                            "scoresFor" => 38,
                            "scoresAgainst" => 35,
                            "id" => 1134304,
                            "losses" => 9,
                            "draws" => 3,
                            "points" => 27,
                            "scoreDiffFormatted" => "+3",
                        ],
                        [
                            "team" => [
                                "name" => "Tottenham Hotspur",
                                "slug" => "tottenham-hotspur",
                                "shortName" => "Tottenham ",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 1303557,
                                "nameCode" => "TOT",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 33,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#000066",
                                    "text" => "#000066",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "توتنهام هوتسبر",
                                        "ru" => "Тоттенхэм Хотспур",
                                        "hi" => "टॉटनहैम हॉटस्पर",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "توتنهام",
                                        "hi" => "टॉटनहैम",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 12,
                            "matches" => 20,
                            "wins" => 7,
                            "scoresFor" => 42,
                            "scoresAgainst" => 30,
                            "id" => 1134318,
                            "losses" => 10,
                            "draws" => 3,
                            "points" => 24,
                            "scoreDiffFormatted" => "+12",
                        ],
                        [
                            "team" => [
                                "name" => "Manchester United",
                                "slug" => "manchester-united",
                                "shortName" => "Man Utd",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 2544639,
                                "nameCode" => "MUN",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 35,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff0000",
                                    "secondary" => "#373737",
                                    "text" => "#373737",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر يونايتد",
                                        "ru" => "Манчестер Юнайтед",
                                        "hi" => "मैनचेस्टर यूनाइटेड",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان يونايتد",
                                        "hi" => "मैन यूनाइटेड",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 13,
                            "matches" => 20,
                            "wins" => 6,
                            "scoresFor" => 23,
                            "scoresAgainst" => 28,
                            "id" => 1134314,
                            "losses" => 9,
                            "draws" => 5,
                            "points" => 23,
                            "scoreDiffFormatted" => "-5",
                        ],
                        [
                            "team" => [
                                "name" => "West Ham United",
                                "slug" => "west-ham-united",
                                "shortName" => "West Ham",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 666855,
                                "nameCode" => "WHU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 37,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66192c",
                                    "secondary" => "#59b3e4",
                                    "text" => "#59b3e4",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "وست هام يونايتد",
                                        "ru" => "Вест Хэм Юнайтед",
                                        "hi" => "वेस्ट हैम यूनाइटेड",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "وست هام",
                                        "hi" => "वेस्ट हैम",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 14,
                            "matches" => 20,
                            "wins" => 6,
                            "scoresFor" => 24,
                            "scoresAgainst" => 39,
                            "id" => 1134319,
                            "losses" => 9,
                            "draws" => 5,
                            "points" => 23,
                            "scoreDiffFormatted" => "-15",
                        ],
                        [
                            "team" => [
                                "name" => "Crystal Palace",
                                "slug" => "crystal-palace",
                                "shortName" => "Crystal Palace",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 399188,
                                "nameCode" => "CRY",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 7,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0033ff",
                                    "secondary" => "#b90d2b",
                                    "text" => "#b90d2b",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "ru" => "Кристал Пэлас",
                                        "hi" => "क्रिस्टल पैलेस",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "hi" => "क्रिस्टल पैलेस",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 15,
                            "matches" => 20,
                            "wins" => 4,
                            "scoresFor" => 21,
                            "scoresAgainst" => 28,
                            "id" => 1134307,
                            "losses" => 7,
                            "draws" => 9,
                            "points" => 21,
                            "scoreDiffFormatted" => "-7",
                        ],
                        [
                            "team" => [
                                "name" => "Everton",
                                "slug" => "everton",
                                "shortName" => "Everton",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 456648,
                                "nameCode" => "EVE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 48,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#274488",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "إيفرتون",
                                        "ru" => "Эвертон",
                                        "hi" => "एवर्टन",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "إيفرتون",
                                        "hi" => "एवर्टन",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 16,
                            "matches" => 19,
                            "wins" => 3,
                            "scoresFor" => 15,
                            "scoresAgainst" => 25,
                            "id" => 1134308,
                            "losses" => 8,
                            "draws" => 8,
                            "points" => 17,
                            "scoreDiffFormatted" => "-10",
                        ],
                        [
                            "team" => [
                                "name" => "Wolverhampton",
                                "slug" => "wolverhampton",
                                "shortName" => "Wolves",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 407157,
                                "nameCode" => "WOL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 3,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff9900",
                                    "secondary" => "#000000",
                                    "text" => "#000000",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ولفرهامبتون",
                                        "ru" => "Вулверхэмптон Уондерерс",
                                        "hi" => "वॉल्वरहैम्प्टन",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "وولفز",
                                        "hi" => "वॉल्व्स",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "position" => 17,
                            "matches" => 20,
                            "wins" => 4,
                            "scoresFor" => 31,
                            "scoresAgainst" => 45,
                            "id" => 1134320,
                            "losses" => 12,
                            "draws" => 4,
                            "points" => 16,
                            "scoreDiffFormatted" => "-14",
                        ],
                        [
                            "team" => [
                                "name" => "Ipswich Town",
                                "slug" => "ipswich-town",
                                "shortName" => "Ipswich",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 145950,
                                "nameCode" => "IPS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 32,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0000ff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ايبسويتش تاون",
                                        "ru" => "Ипсвич Таун",
                                    ],
                                    "shortNameTranslation" => [],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Relegation",
                                "id" => 3
                            ],
                            "position" => 18,
                            "matches" => 20,
                            "wins" => 3,
                            "scoresFor" => 20,
                            "scoresAgainst" => 35,
                            "id" => 1134310,
                            "losses" => 10,
                            "draws" => 7,
                            "points" => 16,
                            "scoreDiffFormatted" => "-15",
                        ],
                        [
                            "team" => [
                                "name" => "Leicester City",
                                "slug" => "leicester-city",
                                "shortName" => "Leicester",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 528991,
                                "nameCode" => "LEI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 31,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#003090",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليستر سيتي",
                                        "ru" => "Лестер Сити",
                                        "hi" => "लीसेस्टर सिटी",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليستر",
                                        "hi" => "लीसेस्टर",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Relegation",
                                "id" => 3
                            ],
                            "position" => 19,
                            "matches" => 20,
                            "wins" => 3,
                            "scoresFor" => 23,
                            "scoresAgainst" => 44,
                            "id" => 1134311,
                            "losses" => 12,
                            "draws" => 5,
                            "points" => 14,
                            "scoreDiffFormatted" => "-21",
                        ],
                        [
                            "team" => [
                                "name" => "Southampton",
                                "slug" => "southampton",
                                "shortName" => "Southampton",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1,
                                ],
                                "userCount" => 210779,
                                "nameCode" => "SOU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 45,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ساوثهامبتون",
                                        "ru" => "Саутгемптон",
                                        "hi" => "साउथेम्प्टन",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ساوثهامبتون",
                                        "hi" => "साउथेम्प्टन",
                                    ],
                                ],
                            ],
                            "descriptions" => [],
                            "promotion" => [
                                "text" => "Relegation",
                                "id" => 3
                            ],
                            "position" => 20,
                            "matches" => 20,
                            "wins" => 1,
                            "scoresFor" => 12,
                            "scoresAgainst" => 44,
                            "id" => 1134317,
                            "losses" => 16,
                            "draws" => 3,
                            "points" => 6,
                            "scoreDiffFormatted" => "-32",
                        ],
                    ],
                    "id" => 126654,
                    "updatedAtTimestamp" => 1724529094,
                ],
            ],
        ];

        return $arrayVar;
    }
}
