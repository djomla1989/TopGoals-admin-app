<?php

namespace App\Jobs\Sync\Season;

use App\Builder\Player\PlayerBuilder;
use App\Builder\Season\SeasonRoundTeamOfTheWeekBuilder;
use App\Builder\Season\SeasonRoundTeamOfTheWeekPlayerBuilder;
use App\Builder\Team\TeamBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\SeasonRound;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSeasonRoundsTeamOfTheWeekPlayerJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    private SeasonRound $seasonRound;

    /**
     * Create a new job instance.
     */
    public function __construct(SeasonRound $seasonRound)
    {
        $this->seasonRound = $seasonRound;
    }

    public function uniqueId(): string
    {
        return get_class($this->seasonRound) . '-team-of-the-week-players' . $this->seasonRound->getId();
    }

    public function failed(\Throwable $exception): void
    {
        info('Season round team of the week players data sync failed', [
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
            if (false === config('sync.syncInactive') && $this->seasonRound->season->getIsActive() === false) {
                info('Season is inactive', ['season' => $this->seasonRound->season->id]);
                return;
            }

            $lastSync = $this->seasonRound->season->getLastSync();

            if (!empty($lastSync) && $this->getLastSyncComparatorDate()->lessThan($lastSync)) {
                info('Season last sync is less than a day', ['season' => $this->seasonRound->season->getId()]);
                return;
            }

            //$data = $this->getData($this->getUrl());
            $data = $this->getExampleData();

            $data = $data['data'] ?? [];

            if (empty($data) || empty($data['players'])) {
                info('Season round team of the week is empty', ['season' => $this->seasonRound->getId()]);
                return;
            }

            $seasonRoundTeamOfTheWeek = SeasonRoundTeamOfTheWeekBuilder::build($this->seasonRound, $data);
            $seasonRoundTeamOfTheWeek->save();

            foreach ($data['players'] as $playerData) {
                $player = PlayerBuilder::build($playerData['player'], $this->seasonRound->season->tournament->sport);
                $player->save();

                $team = TeamBuilder::build($playerData['team'], $this->seasonRound->season->tournament->sport);
                $team->save();

                $seasonRoundTeamOfTheWeekPlayer = SeasonRoundTeamOfTheWeekPlayerBuilder::build($seasonRoundTeamOfTheWeek, $player, $playerData);
                $seasonRoundTeamOfTheWeekPlayer->save();
            }

            info('Season rounds team of the week players data synced', ['season' => $this->seasonRound->getId()]);
        } catch (\Throwable $exception) {
            info('Season round team of the week players data sync failed', [
                'season' => $this->seasonRound->getId(),
                'exception' => $exception->getMessage()
            ]);
        }
    }

    public function getUrl(): string
    {
        return sprintf(
            'seasons/team-week/result?seasons_id=%s&unique_tournament_id=%s&round_id=%s',
            $this->seasonRound->season->getSourceId(),
            $this->seasonRound->season->tournament->getSourceId(),
            $this->seasonRound->getSourceId()
        );
    }

    public function getExampleData(): array
    {


        $jayParsedAry = [
            "data" => [
                "formation" => "4-1-3-2",
                "players" => [
                    [
                        "player" => [
                            "name" => "Alisson",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "alisson",
                            "shortName" => "Alisson",
                            "position" => "G",
                            "jerseyNumber" => "1",
                            "userCount" => 61341,
                            "id" => 243609,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أليسون",
                                    "hi" => "एलिसन",
                                    "bn" => "অ্যালিসন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أليسون",
                                    "hi" => "एलिसन",
                                    "bn" => "অ্যালিসন"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2581989,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "Usab",
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
                                "userCount" => 374563,
                                "nameCode" => "BRE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 50,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#ff0000",
                                    "text" => "#ff0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "ru" => "Брентфорд",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
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
                                "userCount" => 2581989,
                                "nameCode" => "LIV",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 44,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليفربول",
                                        "ru" => "Ливерпуль",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليفربول",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
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
                                "period1" => 0,
                                "period2" => 2,
                                "normaltime" => 2
                            ],
                            "hasXg" => true,
                            "id" => 12436440,
                            "startTimestamp" => 1737212400,
                            "slug" => "brentford-liverpool",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.6",
                        "order" => 1,
                        "id" => 197154
                    ],
                    [
                        "player" => [
                            "name" => "Trent Alexander-Arnold",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "trent-alexander-arnold",
                            "shortName" => "T. Alexander-Arnold",
                            "position" => "D",
                            "jerseyNumber" => "66",
                            "userCount" => 97175,
                            "id" => 795064,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ترنت ألكسندر-أرنولد",
                                    "hi" => "ट्रेंट अलेक्जेंडर-अर्नोल्ड",
                                    "bn" => "ট্রেন্ট আলেকজান্ডার-আর্নল্ড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ت. ألكسندر-أرنولد",
                                    "hi" => "टी. अलेक्जेंडर-अर्नोल्ड",
                                    "bn" => "টি. আলেকজান্ডার-আর্নল্ড"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2581989,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "Usab",
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
                                "userCount" => 374563,
                                "nameCode" => "BRE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 50,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#ff0000",
                                    "text" => "#ff0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "ru" => "Брентфорд",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
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
                                "userCount" => 2581989,
                                "nameCode" => "LIV",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 44,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليفربول",
                                        "ru" => "Ливерпуль",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليفربول",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
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
                                "period1" => 0,
                                "period2" => 2,
                                "normaltime" => 2
                            ],
                            "hasXg" => true,
                            "id" => 12436440,
                            "startTimestamp" => 1737212400,
                            "slug" => "brentford-liverpool",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.4",
                        "order" => 2,
                        "id" => 197155
                    ],
                    [
                        "player" => [
                            "name" => "Dean Huijsen",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "dean-huijsen",
                            "shortName" => "D. Huijsen",
                            "position" => "D",
                            "jerseyNumber" => "2",
                            "userCount" => 3766,
                            "id" => 1176744,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "دين هويسين",
                                    "hi" => "डीन हुइजसेन",
                                    "bn" => "ডিন হুইজসেন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "د. هويسين",
                                    "hi" => "डी. हुइजसेन",
                                    "bn" => "ডি. হুইজসেন"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Bournemouth",
                            "slug" => "bournemouth",
                            "shortName" => "Bournemouth",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 297299,
                            "nameCode" => "BOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 60,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بورنموث",
                                    "ru" => "Борнмут",
                                    "hi" => "बोर्नमाउथ",
                                    "bn" => "বোর্নেমাউথ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بورنموث",
                                    "hi" => "बोर्नमाउथ",
                                    "bn" => "বোর্নেমাউথ"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "Okb",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 2,
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
                                "userCount" => 902996,
                                "nameCode" => "NEW",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 39,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "نيوكاسل يونايتد",
                                        "ru" => "Ньюкасл Юнайтед",
                                        "hi" => "न्यूकैसल यूनाइटेड",
                                        "bn" => "নিউক্যাসল ইউনাইটেড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "نيوكاسل",
                                        "hi" => "न्यूकैसल",
                                        "bn" => "নিউক্যাসল"
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
                                "userCount" => 297299,
                                "nameCode" => "BOU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 60,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#cc0000",
                                    "text" => "#cc0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "بورنموث",
                                        "ru" => "Борнмут",
                                        "hi" => "बोर्नमाउथ",
                                        "bn" => "বোর্নেমাউথ"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "بورنموث",
                                        "hi" => "बोर्नमाउथ",
                                        "bn" => "বোর্নেমাউথ"
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
                                "current" => 4,
                                "display" => 4,
                                "period1" => 2,
                                "period2" => 2,
                                "normaltime" => 4
                            ],
                            "hasXg" => true,
                            "id" => 12436885,
                            "startTimestamp" => 1737203400,
                            "slug" => "bournemouth-newcastle-united",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.3",
                        "order" => 3,
                        "id" => 197156
                    ],
                    [
                        "player" => [
                            "name" => "Trevoh Chalobah",
                            "slug" => "trevoh-chalobah",
                            "shortName" => "T. Chalobah",
                            "position" => "D",
                            "jerseyNumber" => "23",
                            "userCount" => 6677,
                            "id" => 826134,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "تريفوه تشالوبا",
                                    "hi" => "ट्रेवोह चालोबा",
                                    "bn" => "ত্রেভহ চালোবাহ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ت. تشالوبا",
                                    "hi" => "टी. चालोबा",
                                    "bn" => "টি. চালোবাহ"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2124981,
                            "nameCode" => "CHE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#0310a7",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "ru" => "Челси",
                                    "hi" => "चेल्सी",
                                    "bn" => "চেলসি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "تشيلسي",
                                    "hi" => "चेल्सी",
                                    "bn" => "চেলসি"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "dsN",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 1,
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
                                "userCount" => 2124981,
                                "nameCode" => "CHE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 38,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0310a7",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "ru" => "Челси",
                                        "hi" => "चेल्सी",
                                        "bn" => "চেলসি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "hi" => "चेल्सी",
                                        "bn" => "চেলসি"
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
                                "userCount" => 416493,
                                "nameCode" => "WOL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 3,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff9900",
                                    "secondary" => "#000000",
                                    "text" => "#000000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ولفرهامبتون",
                                        "ru" => "Вулверхэмптон Уондерерс",
                                        "hi" => "वॉल्वरहैम्प्टन",
                                        "bn" => "উলভারহ্যাম্পটন"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "وولفز",
                                        "hi" => "वॉल्व्स",
                                        "bn" => "উলভস"
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
                            "hasXg" => true,
                            "id" => 12436455,
                            "startTimestamp" => 1737403200,
                            "slug" => "chelsea-wolverhampton",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.4",
                        "order" => 4,
                        "id" => 197157
                    ],
                    [
                        "player" => [
                            "name" => "Antonee Robinson",
                            "slug" => "antonee-robinson",
                            "shortName" => "A. Robinson",
                            "position" => "D",
                            "jerseyNumber" => "33",
                            "userCount" => 3269,
                            "id" => 803174,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أنتوني روبنسون",
                                    "hi" => "एंटोनी रॉबिन्सन",
                                    "bn" => "অ্যান্টনি রবিনসন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أ. روبنسون",
                                    "hi" => "ए. रॉबिन्सन",
                                    "bn" => "এ. রবিনসন"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Fulham",
                            "slug" => "fulham",
                            "shortName" => "Fulham",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 408476,
                            "nameCode" => "FUL",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 43,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#000000",
                                "text" => "#000000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "فولهام",
                                    "ru" => "Фулхэм",
                                    "hi" => "फुलहम",
                                    "bn" => "ফুলহাম"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "فولهام",
                                    "hi" => "फुलहम",
                                    "bn" => "ফুলহাম"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "GsT",
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
                                "userCount" => 534271,
                                "nameCode" => "LEI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 31,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#003090",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليستر سيتي",
                                        "ru" => "Лестер Сити",
                                        "hi" => "लीसेस्टर सिटी",
                                        "bn" => "লেস্টার সিটি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليستر",
                                        "hi" => "लीसेस्टर",
                                        "bn" => "লেস্টার"
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
                                "userCount" => 408476,
                                "nameCode" => "FUL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 43,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#000000",
                                    "text" => "#000000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "فولهام",
                                        "ru" => "Фулхэм",
                                        "hi" => "फुलहम",
                                        "bn" => "ফুলহাম"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "فولهام",
                                        "hi" => "फुलहम",
                                        "bn" => "ফুলহাম"
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
                                "period1" => 0,
                                "period2" => 2,
                                "normaltime" => 2
                            ],
                            "hasXg" => true,
                            "id" => 12436442,
                            "startTimestamp" => 1737212400,
                            "slug" => "fulham-leicester-city",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.1",
                        "order" => 5,
                        "id" => 197158
                    ],
                    [
                        "player" => [
                            "name" => "Mateo Kovačić",
                            "slug" => "mateo-kovacic",
                            "shortName" => "M. Kovačić",
                            "position" => "M",
                            "jerseyNumber" => "8",
                            "userCount" => 37175,
                            "id" => 136710,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ماتيو كوفاسيتش",
                                    "hi" => "माटेओ कोवासिक",
                                    "bn" => "মাতেও কোভাসিক"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. كوفاسيتش",
                                    "hi" => "एम. कोवासिक",
                                    "bn" => "এম. কোভাসিচ"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2883299,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी",
                                    "bn" => "ম্যানচেস্টার সিটি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी",
                                    "bn" => "ম্যান সিটি"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "rsH",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 2,
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
                                "userCount" => 154305,
                                "nameCode" => "IPS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 32,
                                "entityType" => "team",
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
                                "name" => "Manchester City",
                                "slug" => "manchester-city",
                                "shortName" => "Man City",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "userCount" => 2883299,
                                "nameCode" => "MCI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 17,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66ccff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر سيتي",
                                        "ru" => "Манчестер Сити",
                                        "hi" => "मैनचेस्टर सिटी",
                                        "bn" => "ম্যানচেস্টার সিটি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان سيتي",
                                        "hi" => "मैन सिटी",
                                        "bn" => "ম্যান সিটি"
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
                                "current" => 6,
                                "display" => 6,
                                "period1" => 3,
                                "period2" => 3,
                                "normaltime" => 6
                            ],
                            "hasXg" => true,
                            "id" => 12436439,
                            "startTimestamp" => 1737304200,
                            "slug" => "ipswich-town-manchester-city",
                            "finalResultOnly" => false
                        ],
                        "rating" => "9.6",
                        "order" => 6,
                        "id" => 197159
                    ],
                    [
                        "player" => [
                            "name" => "Phil Foden",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "phil-foden",
                            "shortName" => "P. Foden",
                            "position" => "M",
                            "jerseyNumber" => "47",
                            "userCount" => 210466,
                            "id" => 859765,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "فيل فودين",
                                    "hi" => "फिल फोडेन",
                                    "bn" => "ফিল ফোডেন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ف. فودين",
                                    "hi" => "पी. फोडेन",
                                    "bn" => "পি. ফোডেন"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2883299,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी",
                                    "bn" => "ম্যানচেস্টার সিটি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी",
                                    "bn" => "ম্যান সিটি"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "rsH",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 2,
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
                                "userCount" => 154305,
                                "nameCode" => "IPS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 32,
                                "entityType" => "team",
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
                                "name" => "Manchester City",
                                "slug" => "manchester-city",
                                "shortName" => "Man City",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "userCount" => 2883299,
                                "nameCode" => "MCI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 17,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66ccff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر سيتي",
                                        "ru" => "Манчестер Сити",
                                        "hi" => "मैनचेस्टर सिटी",
                                        "bn" => "ম্যানচেস্টার সিটি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان سيتي",
                                        "hi" => "मैन सिटी",
                                        "bn" => "ম্যান সিটি"
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
                                "current" => 6,
                                "display" => 6,
                                "period1" => 3,
                                "period2" => 3,
                                "normaltime" => 6
                            ],
                            "hasXg" => true,
                            "id" => 12436439,
                            "startTimestamp" => 1737304200,
                            "slug" => "ipswich-town-manchester-city",
                            "finalResultOnly" => false
                        ],
                        "rating" => "9.0",
                        "order" => 7,
                        "id" => 197160
                    ],
                    [
                        "player" => [
                            "name" => "Justin Kluivert",
                            "slug" => "justin-kluivert",
                            "shortName" => "J. Kluivert",
                            "position" => "M",
                            "jerseyNumber" => "19",
                            "userCount" => 4868,
                            "id" => 851596,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جاستن كلويفرت",
                                    "hi" => "जस्टिन क्लुइवर्ट",
                                    "bn" => "জাস্টিন ক্লুইভার্ট"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. كلويفرت",
                                    "hi" => "जे. क्लुइवर्ट",
                                    "bn" => "জে. ক্লুইভার্ট"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Bournemouth",
                            "slug" => "bournemouth",
                            "shortName" => "Bournemouth",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 297299,
                            "nameCode" => "BOU",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 60,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#cc0000",
                                "text" => "#cc0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بورنموث",
                                    "ru" => "Борнмут",
                                    "hi" => "बोर्नमाउथ",
                                    "bn" => "বোর্নেমাউথ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بورنموث",
                                    "hi" => "बोर्नमाउथ",
                                    "bn" => "বোর্নেমাউথ"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "Okb",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 2,
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
                                "userCount" => 902996,
                                "nameCode" => "NEW",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 39,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "نيوكاسل يونايتد",
                                        "ru" => "Ньюкасл Юнайтед",
                                        "hi" => "न्यूकैसल यूनाइटेड",
                                        "bn" => "নিউক্যাসল ইউনাইটেড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "نيوكاسل",
                                        "hi" => "न्यूकैसल",
                                        "bn" => "নিউক্যাসল"
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
                                "userCount" => 297299,
                                "nameCode" => "BOU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 60,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#cc0000",
                                    "text" => "#cc0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "بورنموث",
                                        "ru" => "Борнмут",
                                        "hi" => "बोर्नमाउथ",
                                        "bn" => "বোর্নেমাউথ"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "بورنموث",
                                        "hi" => "बोर्नमाउथ",
                                        "bn" => "বোর্নেমাউথ"
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
                                "current" => 4,
                                "display" => 4,
                                "period1" => 2,
                                "period2" => 2,
                                "normaltime" => 4
                            ],
                            "hasXg" => true,
                            "id" => 12436885,
                            "startTimestamp" => 1737203400,
                            "slug" => "bournemouth-newcastle-united",
                            "finalResultOnly" => false
                        ],
                        "rating" => "9.9",
                        "order" => 8,
                        "id" => 197161
                    ],
                    [
                        "player" => [
                            "name" => "Jérémy Doku",
                            "slug" => "jeremy-doku",
                            "shortName" => "J. Doku",
                            "position" => "F",
                            "jerseyNumber" => "11",
                            "userCount" => 63499,
                            "id" => 934386,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جيريمي دوكو",
                                    "hi" => "जेरेमी डोकू",
                                    "bn" => "জেরেমি ডকু"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. دوكو",
                                    "hi" => "जे. डोकू",
                                    "bn" => "জে. ডকু"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2883299,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी",
                                    "bn" => "ম্যানচেস্টার সিটি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी",
                                    "bn" => "ম্যান সিটি"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "rsH",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 2,
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
                                "userCount" => 154305,
                                "nameCode" => "IPS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 32,
                                "entityType" => "team",
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
                                "name" => "Manchester City",
                                "slug" => "manchester-city",
                                "shortName" => "Man City",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "userCount" => 2883299,
                                "nameCode" => "MCI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 17,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66ccff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر سيتي",
                                        "ru" => "Манчестер Сити",
                                        "hi" => "मैनचेस्टर सिटी",
                                        "bn" => "ম্যানচেস্টার সিটি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان سيتي",
                                        "hi" => "मैन सिटी",
                                        "bn" => "ম্যান সিটি"
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
                                "current" => 6,
                                "display" => 6,
                                "period1" => 3,
                                "period2" => 3,
                                "normaltime" => 6
                            ],
                            "hasXg" => true,
                            "id" => 12436439,
                            "startTimestamp" => 1737304200,
                            "slug" => "ipswich-town-manchester-city",
                            "finalResultOnly" => false
                        ],
                        "rating" => "9.1",
                        "order" => 9,
                        "id" => 197162
                    ],
                    [
                        "player" => [
                            "name" => "Jean-Philippe Mateta",
                            "slug" => "jean-philippe-mateta",
                            "shortName" => "J. Mateta",
                            "position" => "F",
                            "jerseyNumber" => "14",
                            "userCount" => 3864,
                            "id" => 848276,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جان-فيليب ماتيتا",
                                    "hi" => "जीन-फिलिप माटेटा",
                                    "bn" => "জিন-ফিলিপ মাটেটা"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. ماتيتا",
                                    "hi" => "जे. माटेटा",
                                    "bn" => "জে. মাটেটা"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 403282,
                            "nameCode" => "CRY",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#0033ff",
                                "secondary" => "#b90d2b",
                                "text" => "#b90d2b"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "ru" => "Кристал Пэлас",
                                    "hi" => "क्रिस्टल पैलेस",
                                    "bn" => "ক্রিস্টাল প্যালেস"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "كريستال بالاس",
                                    "hi" => "क्रिस्टल पैलेस",
                                    "bn" => "ক্রিস্টাল প্যালেস"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "hsM",
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
                                "userCount" => 671482,
                                "nameCode" => "WHU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 37,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66192c",
                                    "secondary" => "#59b3e4",
                                    "text" => "#59b3e4"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "وست هام يونايتد",
                                        "ru" => "Вест Хэм Юнайтед",
                                        "hi" => "वेस्ट हैम यूनाइटेड",
                                        "bn" => "ওয়েস্ট হ্যাম ইউনাইটেড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "وست هام",
                                        "hi" => "वेस्ट हैम",
                                        "bn" => "ওয়েস্ট হ্যাম"
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
                                "userCount" => 403282,
                                "nameCode" => "CRY",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 7,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0033ff",
                                    "secondary" => "#b90d2b",
                                    "text" => "#b90d2b"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "ru" => "Кристал Пэлас",
                                        "hi" => "क्रिस्टल पैलेस",
                                        "bn" => "ক্রিস্টাল প্যালেস"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "hi" => "क्रिस्टल पैलेस",
                                        "bn" => "ক্রিস্টাল প্যালেস"
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
                                "period1" => 0,
                                "period2" => 2,
                                "normaltime" => 2
                            ],
                            "hasXg" => true,
                            "id" => 12436889,
                            "startTimestamp" => 1737212400,
                            "slug" => "west-ham-united-crystal-palace",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.9",
                        "order" => 10,
                        "id" => 197163
                    ],
                    [
                        "player" => [
                            "name" => "Darwin Núñez",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "darwin-nunez",
                            "shortName" => "D. Núñez",
                            "position" => "F",
                            "jerseyNumber" => "9",
                            "userCount" => 86159,
                            "id" => 924871,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "داروين نونيز",
                                    "hi" => "डार्विन नुन्येज़",
                                    "bn" => "ডারউইন নুনেজ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "د. نونيز",
                                    "hi" => "डी. नुन्येज़",
                                    "bn" => "ডি. নুনেজ"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2581989,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "Usab",
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
                                "userCount" => 374563,
                                "nameCode" => "BRE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 50,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#ff0000",
                                    "text" => "#ff0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "ru" => "Брентфорд",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
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
                                "userCount" => 2581989,
                                "nameCode" => "LIV",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 44,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليفربول",
                                        "ru" => "Ливерпуль",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليفربول",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
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
                                "period1" => 0,
                                "period2" => 2,
                                "normaltime" => 2
                            ],
                            "hasXg" => true,
                            "id" => 12436440,
                            "startTimestamp" => 1737212400,
                            "slug" => "brentford-liverpool",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.6",
                        "order" => 11,
                        "id" => 197164
                    ]
                ]
            ]
        ];


        $jayParsedAry = [
            "data" => [
                "formation" => "3-4-3",
                "players" => [
                    [
                        "player" => [
                            "name" => "Mark Flekken",
                            "slug" => "mark-flekken",
                            "shortName" => "M. Flekken",
                            "position" => "G",
                            "jerseyNumber" => "1",
                            "userCount" => 2040,
                            "id" => 171919,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مارك فليكين",
                                    "hi" => "मार्क फ्लेकेन",
                                    "bn" => "মার্ক ফ্লেককেন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. فليكين",
                                    "hi" => "एम. फ्लेकेन",
                                    "bn" => "এম. ফ্লেকেন"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 374563,
                            "nameCode" => "BRE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#ff0000",
                                "text" => "#ff0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "ru" => "Брентфорд",
                                    "hi" => "ब्रेंटफोर्ड",
                                    "bn" => "ব্রেন্টফোর্ড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "hi" => "ब्रेंटफोर्ड",
                                    "bn" => "ব্রেন্টফোর্ড"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "hsab",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 1,
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
                                "userCount" => 374563,
                                "nameCode" => "BRE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 50,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#ff0000",
                                    "text" => "#ff0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "ru" => "Брентфорд",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
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
                                "userCount" => 403282,
                                "nameCode" => "CRY",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 7,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0033ff",
                                    "secondary" => "#b90d2b",
                                    "text" => "#b90d2b"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "ru" => "Кристал Пэлас",
                                        "hi" => "क्रिस्टल पैलेस",
                                        "bn" => "ক্রিস্টাল প্যালেস"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "hi" => "क्रिस्टल पैलेस",
                                        "bn" => "ক্রিস্টাল প্যালেস"
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
                                "period1" => 0,
                                "period2" => 1,
                                "normaltime" => 1
                            ],
                            "hasXg" => true,
                            "id" => 12436879,
                            "startTimestamp" => 1723986000,
                            "slug" => "brentford-crystal-palace",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.4",
                        "order" => 1,
                        "id" => 164495
                    ],
                    [
                        "player" => [
                            "name" => "Nathan Collins",
                            "slug" => "nathan-collins",
                            "shortName" => "N. Collins",
                            "position" => "D",
                            "jerseyNumber" => "22",
                            "userCount" => 1241,
                            "id" => 958916,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ناثان كولينز",
                                    "hi" => "नाथन कोलिन्स",
                                    "bn" => "নাথান কলিন্স"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ن. كولينز",
                                    "hi" => "एन. कोलिन्स",
                                    "bn" => "এন. কলিন্স"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 374563,
                            "nameCode" => "BRE",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#ffffff",
                                "secondary" => "#ff0000",
                                "text" => "#ff0000"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "ru" => "Брентфорд",
                                    "hi" => "ब्रेंटफोर्ड",
                                    "bn" => "ব্রেন্টফোর্ড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برينتفورد",
                                    "hi" => "ब्रेंटफोर्ड",
                                    "bn" => "ব্রেন্টফোর্ড"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "hsab",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 1,
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
                                "userCount" => 374563,
                                "nameCode" => "BRE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 50,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#ff0000",
                                    "text" => "#ff0000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "ru" => "Брентфорд",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برينتفورد",
                                        "hi" => "ब्रेंटफोर्ड",
                                        "bn" => "ব্রেন্টফোর্ড"
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
                                "userCount" => 403282,
                                "nameCode" => "CRY",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 7,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0033ff",
                                    "secondary" => "#b90d2b",
                                    "text" => "#b90d2b"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "ru" => "Кристал Пэлас",
                                        "hi" => "क्रिस्टल पैलेस",
                                        "bn" => "ক্রিস্টাল প্যালেস"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "كريستال بالاس",
                                        "hi" => "क्रिस्टल पैलेस",
                                        "bn" => "ক্রিস্টাল প্যালেস"
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
                                "period1" => 0,
                                "period2" => 1,
                                "normaltime" => 1
                            ],
                            "hasXg" => true,
                            "id" => 12436879,
                            "startTimestamp" => 1723986000,
                            "slug" => "brentford-crystal-palace",
                            "finalResultOnly" => false
                        ],
                        "rating" => "7.3",
                        "order" => 2,
                        "id" => 164496
                    ],
                    [
                        "player" => [
                            "name" => "Lisandro Martínez",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "lisandro-martinez",
                            "shortName" => "L. Martínez",
                            "position" => "D",
                            "jerseyNumber" => "6",
                            "userCount" => 54669,
                            "id" => 859999,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليساندرو مارتينيز",
                                    "hi" => "लिसांड्रो मार्टिनेज",
                                    "bn" => "লিসান্দ্রো মার্টিনেজ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ل. مارتينيز",
                                    "hi" => "एल. मार्टिनेज",
                                    "bn" => "এল. মার্টিনেজ"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Man Utd",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2582609,
                            "nameCode" => "MUN",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#373737",
                                "text" => "#373737"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر يونايتد",
                                    "ru" => "Манчестер Юнайтед",
                                    "hi" => "मैनचेस्टर यूनाइटेड",
                                    "bn" => "ম্যানচেস্টার ইউনাইটেড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان يونايتد",
                                    "hi" => "मैन यूनाइटेड",
                                    "bn" => "ম্যান ইউনাইটেড"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "KsT",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 1,
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
                                "userCount" => 2582609,
                                "nameCode" => "MUN",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 35,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff0000",
                                    "secondary" => "#373737",
                                    "text" => "#373737"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر يونايتد",
                                        "ru" => "Манчестер Юнайтед",
                                        "hi" => "मैनचेस्टर यूनाइटेड",
                                        "bn" => "ম্যানচেস্টার ইউনাইটেড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان يونايتد",
                                        "hi" => "मैन यूनाइटेड",
                                        "bn" => "ম্যান ইউনাইটেড"
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
                                "userCount" => 408476,
                                "nameCode" => "FUL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 43,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#000000",
                                    "text" => "#000000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "فولهام",
                                        "ru" => "Фулхэм",
                                        "hi" => "फुलहम",
                                        "bn" => "ফুলহাম"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "فولهام",
                                        "hi" => "फुलहम",
                                        "bn" => "ফুলহাম"
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
                            "hasXg" => true,
                            "id" => 12436870,
                            "startTimestamp" => 1723834800,
                            "slug" => "fulham-manchester-united",
                            "finalResultOnly" => false
                        ],
                        "rating" => "7.3",
                        "order" => 3,
                        "id" => 164497
                    ],
                    [
                        "player" => [
                            "name" => "Joško Gvardiol",
                            "slug" => "josko-gvardiol",
                            "shortName" => "J. Gvardiol",
                            "position" => "D",
                            "jerseyNumber" => "24",
                            "userCount" => 52062,
                            "id" => 964994,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "يوشكو غفارديول",
                                    "hi" => "जोस्को ग्वार्डिओल",
                                    "bn" => "জোসকো গোওয়ারদিওল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ي. غفارديول",
                                    "hi" => "जे. ग्वार्डिओल",
                                    "bn" => "জে. গোওয়ারদিওল"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2883299,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी",
                                    "bn" => "ম্যানচেস্টার সিটি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी",
                                    "bn" => "ম্যান সিটি"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "rN",
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
                                "userCount" => 2124981,
                                "nameCode" => "CHE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 38,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0310a7",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "ru" => "Челси",
                                        "hi" => "चेल्सी",
                                        "bn" => "চেলসি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "hi" => "चेल्सी",
                                        "bn" => "চেলসি"
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
                                "userCount" => 2883299,
                                "nameCode" => "MCI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 17,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66ccff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر سيتي",
                                        "ru" => "Манчестер Сити",
                                        "hi" => "मैनचेस्टर सिटी",
                                        "bn" => "ম্যানচেস্টার সিটি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان سيتي",
                                        "hi" => "मैन सिटी",
                                        "bn" => "ম্যান সিটি"
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
                            "hasXg" => true,
                            "id" => 12436880,
                            "startTimestamp" => 1723995000,
                            "slug" => "chelsea-manchester-city",
                            "finalResultOnly" => false
                        ],
                        "rating" => "7.6",
                        "order" => 4,
                        "id" => 164498
                    ],
                    [
                        "player" => [
                            "name" => "Bukayo Saka",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "bukayo-saka",
                            "shortName" => "B. Saka",
                            "position" => "F",
                            "jerseyNumber" => "7",
                            "userCount" => 167351,
                            "id" => 934235,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بوكايو ساكا",
                                    "hi" => "बुकायो साका",
                                    "bn" => "বুকায়ো সাকা"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ب. ساكا",
                                    "hi" => "बी. साका",
                                    "bn" => "বি. সাকা"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2329744,
                            "nameCode" => "ARS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ارسنال",
                                    "ru" => "Арсенал",
                                    "hi" => "आर्सेनल",
                                    "bn" => "আর্সেনাল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ارسنال",
                                    "hi" => "आर्सेनल",
                                    "bn" => "আর্সেনাল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "dsR",
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
                                "userCount" => 2329744,
                                "nameCode" => "ARS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 42,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ارسنال",
                                        "ru" => "Арсенал",
                                        "hi" => "आर्सेनल",
                                        "bn" => "আর্সেনাল"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ارسنال",
                                        "hi" => "आर्सेनल",
                                        "bn" => "আর্সেনাল"
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
                                "userCount" => 416493,
                                "nameCode" => "WOL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 3,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff9900",
                                    "secondary" => "#000000",
                                    "text" => "#000000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ولفرهامبتون",
                                        "ru" => "Вулверхэмптон Уондерерс",
                                        "hi" => "वॉल्वरहैम्प्टन",
                                        "bn" => "উলভারহ্যাম্পটন"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "وولفز",
                                        "hi" => "वॉल्व्स",
                                        "bn" => "উলভস"
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
                            "hasXg" => true,
                            "id" => 12436872,
                            "startTimestamp" => 1723903200,
                            "slug" => "arsenal-wolverhampton",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.9",
                        "order" => 5,
                        "id" => 164499
                    ],
                    [
                        "player" => [
                            "name" => "Casemiro",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "casemiro",
                            "shortName" => "Casemiro",
                            "position" => "M",
                            "jerseyNumber" => "18",
                            "userCount" => 108867,
                            "id" => 122951,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كاسيميرو",
                                    "hi" => "कैसेमिरो",
                                    "bn" => "ক্যাসেমিরো"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "كاسيميرو",
                                    "hi" => "कैसेमिरो",
                                    "bn" => "ক্যাসেমিরো"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Man Utd",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2582609,
                            "nameCode" => "MUN",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#ff0000",
                                "secondary" => "#373737",
                                "text" => "#373737"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر يونايتد",
                                    "ru" => "Манчестер Юнайтед",
                                    "hi" => "मैनचेस्टर यूनाइटेड",
                                    "bn" => "ম্যানচেস্টার ইউনাইটেড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان يونايتد",
                                    "hi" => "मैन यूनाइटेड",
                                    "bn" => "ম্যান ইউনাইটেড"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "KsT",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 1,
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
                                "userCount" => 2582609,
                                "nameCode" => "MUN",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 35,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff0000",
                                    "secondary" => "#373737",
                                    "text" => "#373737"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر يونايتد",
                                        "ru" => "Манчестер Юнайтед",
                                        "hi" => "मैनचेस्टर यूनाइटेड",
                                        "bn" => "ম্যানচেস্টার ইউনাইটেড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان يونايتد",
                                        "hi" => "मैन यूनाइटेड",
                                        "bn" => "ম্যান ইউনাইটেড"
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
                                "userCount" => 408476,
                                "nameCode" => "FUL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 43,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ffffff",
                                    "secondary" => "#000000",
                                    "text" => "#000000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "فولهام",
                                        "ru" => "Фулхэм",
                                        "hi" => "फुलहम",
                                        "bn" => "ফুলহাম"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "فولهام",
                                        "hi" => "फुलहम",
                                        "bn" => "ফুলহাম"
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
                            "hasXg" => true,
                            "id" => 12436870,
                            "startTimestamp" => 1723834800,
                            "slug" => "fulham-manchester-united",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.4",
                        "order" => 6,
                        "id" => 164500
                    ],
                    [
                        "player" => [
                            "name" => "Joelinton",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "joelinton",
                            "shortName" => "Joelinton",
                            "position" => "M",
                            "jerseyNumber" => "7",
                            "userCount" => 6206,
                            "id" => 560128,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جويلينتون",
                                    "hi" => "जोलिंटन",
                                    "bn" => "জোলিন্টন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "جولينتون",
                                    "hi" => "जोएलिंटन",
                                    "bn" => "জোলিন্টন"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 902996,
                            "nameCode" => "NEW",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#000000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نيوكاسل يونايتد",
                                    "ru" => "Ньюкасл Юнайтед",
                                    "hi" => "न्यूकैसल यूनाइटेड",
                                    "bn" => "নিউক্যাসল ইউনাইটেড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نيوكاسل",
                                    "hi" => "न्यूकैसल",
                                    "bn" => "নিউক্যাসল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "OV",
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
                                "userCount" => 902996,
                                "nameCode" => "NEW",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 39,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#000000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "نيوكاسل يونايتد",
                                        "ru" => "Ньюкасл Юнайтед",
                                        "hi" => "न्यूकैसल यूनाइटेड",
                                        "bn" => "নিউক্যাসল ইউনাইটেড"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "نيوكاسل",
                                        "hi" => "न्यूकैसल",
                                        "bn" => "নিউক্যাসল"
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
                                "userCount" => 216786,
                                "nameCode" => "SOU",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 45,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ساوثهامبتون",
                                        "ru" => "Саутгемптон",
                                        "hi" => "साउथेम्प्टन",
                                        "bn" => "সাউদাম্পটন"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ساوثهامبتون",
                                        "hi" => "साउथेम्प्टन",
                                        "bn" => "সাউদাম্পটন"
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
                            "hasXg" => true,
                            "id" => 12436874,
                            "startTimestamp" => 1723903200,
                            "slug" => "southampton-newcastle-united",
                            "finalResultOnly" => false
                        ],
                        "rating" => "7.9",
                        "order" => 7,
                        "id" => 164501
                    ],
                    [
                        "player" => [
                            "name" => "Jérémy Doku",
                            "slug" => "jeremy-doku",
                            "shortName" => "J. Doku",
                            "position" => "F",
                            "jerseyNumber" => "11",
                            "userCount" => 63499,
                            "id" => 934386,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جيريمي دوكو",
                                    "hi" => "जेरेमी डोकू",
                                    "bn" => "জেরেমি ডকু"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. دوكو",
                                    "hi" => "जे. डोकू",
                                    "bn" => "জে. ডকু"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Man City",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2883299,
                            "nameCode" => "MCI",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#66ccff",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانشستر سيتي",
                                    "ru" => "Манчестер Сити",
                                    "hi" => "मैनचेस्टर सिटी",
                                    "bn" => "ম্যানচেস্টার সিটি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "مان سيتي",
                                    "hi" => "मैन सिटी",
                                    "bn" => "ম্যান সিটি"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "rN",
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
                                "userCount" => 2124981,
                                "nameCode" => "CHE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 38,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0310a7",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "ru" => "Челси",
                                        "hi" => "चेल्सी",
                                        "bn" => "চেলসি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "تشيلسي",
                                        "hi" => "चेल्सी",
                                        "bn" => "চেলসি"
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
                                "userCount" => 2883299,
                                "nameCode" => "MCI",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 17,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#66ccff",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "مانشستر سيتي",
                                        "ru" => "Манчестер Сити",
                                        "hi" => "मैनचेस्टर सिटी",
                                        "bn" => "ম্যানচেস্টার সিটি"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "مان سيتي",
                                        "hi" => "मैन सिटी",
                                        "bn" => "ম্যান সিটি"
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
                            "hasXg" => true,
                            "id" => 12436880,
                            "startTimestamp" => 1723995000,
                            "slug" => "chelsea-manchester-city",
                            "finalResultOnly" => false
                        ],
                        "rating" => "7.9",
                        "order" => 8,
                        "id" => 164502
                    ],
                    [
                        "player" => [
                            "name" => "Mohamed Salah",
                            "slug" => "mohamed-salah",
                            "shortName" => "M. Salah",
                            "position" => "F",
                            "jerseyNumber" => "11",
                            "userCount" => 341506,
                            "id" => 159665,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "محمد صلاح",
                                    "hi" => "मोहम्मद सलाह",
                                    "bn" => "মোহাম্মদ সালাহ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. صلاح",
                                    "hi" => "एम. सलाह",
                                    "bn" => "এম. সালাহ"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2581989,
                            "nameCode" => "LIV",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليفربول",
                                    "ru" => "Ливерпуль",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليفربول",
                                    "hi" => "लिवरपूल",
                                    "bn" => "লিভারপুল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "HsU",
                            "status" => [
                                "code" => 100,
                                "description" => "Ended",
                                "type" => "finished"
                            ],
                            "winnerCode" => 2,
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
                                "userCount" => 154305,
                                "nameCode" => "IPS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 32,
                                "entityType" => "team",
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
                                "name" => "Liverpool",
                                "slug" => "liverpool",
                                "shortName" => "Liverpool",
                                "gender" => "M",
                                "sport" => [
                                    "name" => "Football",
                                    "slug" => "football",
                                    "id" => 1
                                ],
                                "userCount" => 2581989,
                                "nameCode" => "LIV",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 44,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ليفربول",
                                        "ru" => "Ливерпуль",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ليفربول",
                                        "hi" => "लिवरपूल",
                                        "bn" => "লিভারপুল"
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
                                "period1" => 0,
                                "period2" => 2,
                                "normaltime" => 2
                            ],
                            "hasXg" => true,
                            "id" => 12436871,
                            "startTimestamp" => 1723894200,
                            "slug" => "liverpool-ipswich-town",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.1",
                        "order" => 9,
                        "id" => 164503
                    ],
                    [
                        "player" => [
                            "name" => "Kai Havertz",
                            "slug" => "kai-havertz",
                            "shortName" => "K. Havertz",
                            "position" => "F",
                            "jerseyNumber" => "29",
                            "userCount" => 90262,
                            "id" => 836705,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كاي هافرتز",
                                    "hi" => "काई हावर्ट्ज़",
                                    "bn" => "কাই হাভার্টজ"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ك. هافيرتز",
                                    "hi" => "के. हावर्ट्ज़",
                                    "bn" => "কে. হাভার্টজ"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 2329744,
                            "nameCode" => "ARS",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#cc0000",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ارسنال",
                                    "ru" => "Арсенал",
                                    "hi" => "आर्सेनल",
                                    "bn" => "আর্সেনাল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ارسنال",
                                    "hi" => "आर्सेनल",
                                    "bn" => "আর্সেনাল"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "dsR",
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
                                "userCount" => 2329744,
                                "nameCode" => "ARS",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 42,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#cc0000",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ارسنال",
                                        "ru" => "Арсенал",
                                        "hi" => "आर्सेनल",
                                        "bn" => "আর্সেনাল"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ارسنال",
                                        "hi" => "आर्सेनल",
                                        "bn" => "আর্সেনাল"
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
                                "userCount" => 416493,
                                "nameCode" => "WOL",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 3,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#ff9900",
                                    "secondary" => "#000000",
                                    "text" => "#000000"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "ولفرهامبتون",
                                        "ru" => "Вулверхэмптон Уондерерс",
                                        "hi" => "वॉल्वरहैम्प्टन",
                                        "bn" => "উলভারহ্যাম্পটন"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "وولفز",
                                        "hi" => "वॉल्व्स",
                                        "bn" => "উলভস"
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
                            "hasXg" => true,
                            "id" => 12436872,
                            "startTimestamp" => 1723903200,
                            "slug" => "arsenal-wolverhampton",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.3",
                        "order" => 10,
                        "id" => 164504
                    ],
                    [
                        "player" => [
                            "name" => "Danny Welbeck",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "danny-welbeck",
                            "shortName" => "D. Welbeck",
                            "position" => "F",
                            "jerseyNumber" => "18",
                            "userCount" => 3416,
                            "id" => 33902,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "داني ويلبيك",
                                    "hi" => "डैनी वेल्बेक",
                                    "bn" => "ড্যানি ওয়েলবেক"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "د. ويلبيك",
                                    "hi" => "डी. वेल्बेक",
                                    "bn" => "ডি. ওয়েলবেক"
                                ]
                            ]
                        ],
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton",
                            "gender" => "M",
                            "sport" => [
                                "name" => "Football",
                                "slug" => "football",
                                "id" => 1
                            ],
                            "userCount" => 620937,
                            "nameCode" => "BHA",
                            "disabled" => false,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#0054a6",
                                "secondary" => "#ffffff",
                                "text" => "#ffffff"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "برايتون وهوف ألبيون",
                                    "ru" => "Брайтон энд Хоув Альбион",
                                    "hi" => "ब्राइटन एंड होव एल्बियन",
                                    "bn" => "ব্রাইটন অ্যান্ড হোভ অ্যালবিয়ন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "برايتون",
                                    "hi" => "ब्राइटन",
                                    "bn" => "ব্রাইটন"
                                ]
                            ]
                        ],
                        "event" => [
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
                                        "flag" => "england",
                                        "alpha2" => "EN"
                                    ],
                                    "userCount" => 1365296,
                                    "id" => 17,
                                    "displayInverseHomeAwayTeams" => false,
                                    "fieldTranslations" => [
                                        "nameTranslation" => [
                                            "ar" => "الدوري الإنجليزي الممتاز",
                                            "hi" => "प्रिमियर लीग",
                                            "bn" => "প্রিমিয়ার লীগ"
                                        ],
                                        "shortNameTranslation" => [
                                        ]
                                    ]
                                ],
                                "priority" => 617,
                                "isLive" => false,
                                "id" => 1,
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "الدوري الإنجليزي الممتاز",
                                        "hi" => "प्रिमियर लीग",
                                        "bn" => "প্রিমিয়ার লীগ"
                                    ],
                                    "shortNameTranslation" => [
                                    ]
                                ]
                            ],
                            "customId" => "FsY",
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
                                "userCount" => 464463,
                                "nameCode" => "EVE",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 48,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#274488",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "إيفرتون",
                                        "ru" => "Эвертон",
                                        "hi" => "एवर्टन",
                                        "bn" => "এভারটন"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "إيفرتون",
                                        "hi" => "एवर्टन",
                                        "bn" => "এভারটন"
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
                                "userCount" => 620937,
                                "nameCode" => "BHA",
                                "disabled" => false,
                                "national" => false,
                                "type" => 0,
                                "id" => 30,
                                "entityType" => "team",
                                "teamColors" => [
                                    "primary" => "#0054a6",
                                    "secondary" => "#ffffff",
                                    "text" => "#ffffff"
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "برايتون وهوف ألبيون",
                                        "ru" => "Брайтон энд Хоув Альбион",
                                        "hi" => "ब्राइटन एंड होव एल्बियन",
                                        "bn" => "ব্রাইটন অ্যান্ড হোভ অ্যালবিয়ন"
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "برايتون",
                                        "hi" => "ब्राइटन",
                                        "bn" => "ব্রাইটন"
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
                                "period1" => 1,
                                "period2" => 2,
                                "normaltime" => 3
                            ],
                            "hasXg" => true,
                            "id" => 12436873,
                            "startTimestamp" => 1723903200,
                            "slug" => "everton-brighton-and-hove-albion",
                            "finalResultOnly" => false
                        ],
                        "rating" => "8.2",
                        "order" => 11,
                        "id" => 164505
                    ]
                ]
            ]
        ];


        return $jayParsedAry;
    }
}
