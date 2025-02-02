<?php

namespace App\Jobs\Sync\Tournament;

use App\Builder\Team\TeamBuilder;
use App\Builder\Tournament\TournamentAdditionalDataBuilder;
use App\Builder\Tournament\TournamentBuilder;
use App\Builder\Tournament\TournamentConnectedTournamentBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Tournament;
use Carbon\Carbon;
use Illuminate\Contracts\Broadcasting\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Spatie\RateLimitedMiddleware\RateLimited;


class SyncTournamentDataJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    private Tournament $tournament;

    /**
     * Create a new job instance.
     */
    public function __construct(Tournament $tournament)
    {
        $this->tournament = $tournament;
        $this->model = $tournament;
    }

    private function uniqueId(): string
    {
        return get_class($this->tournament) . '-' . $this->tournament->id;
    }

    public function middleware(): array
    {
        $rateLimitedMiddleware = (new RateLimited())
            ->allow(config('sync.rateLimit.jobs'))
            ->everySeconds(config('sync.rateLimit.interval'))
            ->releaseAfterSeconds(config('sync.rateLimit.releaseAfter'));

        return [$rateLimitedMiddleware];
    }

    public function failed(\Throwable $exception): void
    {
        info('Tournament data sync failed', [
            'tournament' => $this->tournament->name,
            'exception' => $exception->getMessage()
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if (false === config('sync.syncInactive') && $this->tournament->getIsActive() === false) {
                info('Tournament is inactive', ['tournament' => $this->tournament->id]);
                return;
            }

            $sync = Carbon::now()->subDay();
            $lastSync = $this->tournament->getLastSync();

            if ($lastSync && $sync->lessThan($lastSync)) {
                return;
            }

            $url = $this->getUrl();

            $data = $this->getData($url);
            //$data = $this->getExampleData();
            $data = $data['data'] ?? [];

            if (empty($data)) {
                info('Tournament data not found', ['tournament' => $this->tournament->id]);
                return;
            }

            $tournament = TournamentBuilder::build($this->tournament->sport, $data);
            $tournament->save();

            foreach ($data['upperDivisions'] as $division) {
                $tournament = TournamentBuilder::build($this->tournament->sport, $division);
                $tournament->save();

                $tournamentUpperLowerTournament = TournamentConnectedTournamentBuilder::build($this->tournament, $tournament, 'upper');
                $tournamentUpperLowerTournament->save();
            }

            foreach ($data['lowerDivisions'] as $division) {
                $tournament = TournamentBuilder::build($this->tournament->sport, $division);
                $tournament->save();

                $tournamentUpperLowerTournament = TournamentConnectedTournamentBuilder::build($this->tournament, $tournament, 'lower');
                $tournamentUpperLowerTournament->save();
            }

            if ($data['titleHolder']) {
                $titleHolderTeam = TeamBuilder::build($data['titleHolder'], $this->tournament->sport);
                $titleHolderTeam->save();

                $tournamentAdditionalData = TournamentAdditionalDataBuilder::build($this->tournament, $titleHolderTeam, $data);
                $tournamentAdditionalData->save();
            }

        } catch (\Throwable $th) {
            info('Tournament data sync failed', [
                'tournament' => $this->tournament->id,
                'exception' => $th->getMessage() . "::" . $th->getLine() . "::" . $th->getFile()
            ]);
        }
        info('Tournament data synced', ['tournament' => $this->tournament->id]);
    }

    private function getUrl(): string
    {
        return 'unique-tournaments/data?unique_tournament_id=' . $this->tournament->getSourceId();
    }

    private function getExampleData(): array
    {
        $jayParsedAry = [
            "data" => [
                "name" => "UEFA Europa League",
                "slug" => "uefa-europa-league",
                "secondaryColorHex" => "#f37d25",
                "logo" => [
                    "md5" => "e8138dc92e72bdc892e290f6d2e49d64",
                    "id" => 1854373
                ],
                "darkLogo" => [
                    "md5" => "1ebd8eeb999c74a29d323c01c2501350",
                    "id" => 1854374
                ],
                "category" => [
                    "name" => "Europe",
                    "slug" => "europe",
                    "sport" => [
                        "name" => "Football",
                        "slug" => "football",
                        "id" => 1
                    ],
                    "id" => 1465,
                    "country" => [
                    ],
                    "flag" => "europe"
                ],
                "userCount" => 569475,
                "titleHolder" => [
                    "name" => "Atalanta",
                    "slug" => "atalanta",
                    "shortName" => "Atalanta",
                    "gender" => "M",
                    "sport" => [
                        "name" => "Football",
                        "slug" => "football",
                        "id" => 1
                    ],
                    "userCount" => 763915,
                    "nameCode" => "ATA",
                    "disabled" => false,
                    "national" => false,
                    "type" => 0,
                    "id" => 2686,
                    "country" => [
                        "alpha2" => "IT",
                        "name" => "Italy"
                    ],
                    "entityType" => "team",
                    "teamColors" => [
                        "primary" => "#0000cc",
                        "secondary" => "#000000",
                        "text" => "#000000"
                    ],
                    "fieldTranslations" => [
                        "nameTranslation" => [
                            "ar" => "أتالانتا",
                            "ru" => "Аталанта",
                            "hi" => "अटलांटा"
                        ],
                        "shortNameTranslation" => [
                            "ar" => "أتالانتا",
                            "hi" => "अटलांटा"
                        ]
                    ]
                ],
                "titleHolderTitles" => 1,
                "mostTitles" => 7,
                "mostTitlesTeams" => [
                    [
                        "name" => "Sevilla",
                        "slug" => "sevilla",
                        "shortName" => "Sevilla",
                        "gender" => "M",
                        "sport" => [
                            "name" => "Football",
                            "slug" => "football",
                            "id" => 1
                        ],
                        "userCount" => 580447,
                        "nameCode" => "SEV",
                        "disabled" => false,
                        "national" => false,
                        "type" => 0,
                        "id" => 2833,
                        "country" => [
                            "alpha2" => "ES",
                            "name" => "Spain"
                        ],
                        "entityType" => "team",
                        "teamColors" => [
                            "primary" => "#ffffff",
                            "secondary" => "#cc1020",
                            "text" => "#cc1020"
                        ],
                        "fieldTranslations" => [
                            "nameTranslation" => [
                                "ar" => "إشبيلية",
                                "ru" => "Cевилья",
                                "hi" => "सेविला"
                            ],
                            "shortNameTranslation" => [
                                "ar" => "إشبيلية",
                                "hi" => "सेविला"
                            ]
                        ]
                    ]
                ],
                "linkedUniqueTournaments" => [
                ],
                "hasRounds" => true,
                "hasGroups" => true,
                "hasPlayoffSeries" => false,
                "upperDivisions" => [
                ],
                "lowerDivisions" => [
                ],
                "hasPerformanceGraphFeature" => false,
                "periodLength" => [
                ],
                "id" => 679,
                "country" => [
                ],
                "startDateTimestamp" => 1720656000,
                "endDateTimestamp" => 1747785600,
                "disabledHomeAwayStandings" => false,
                "displayInverseHomeAwayTeams" => false,
                "fieldTranslations" => [
                    "nameTranslation" => [
                        "ar" => "الدوري الأوروبي",
                        "hi" => "यूईएफए यूरोपा लीग"
                    ],
                    "shortNameTranslation" => [
                    ]
                ]
            ]
        ];


        $jayParsedAry = [
            "data" => [
                "name" => "Premier League",
                "slug" => "premier-league",
                "primaryColorHex" => "#3c1c5a",
                "secondaryColorHex" => "#f80158",
                "logo" => [
                    "md5" => "36861710766b10701e2126a2d33021c4",
                    "id" => 1418035
                ],
                "darkLogo" => [
                    "md5" => "cac4c64c7f9e0878f33117bb29f7021a",
                    "id" => 1418033
                ],
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
                        "name" => "England"
                    ],
                    "flag" => "england",
                    "alpha2" => "EN"
                ],
                "userCount" => 1374691,
                "tier" => 1,
                "titleHolder" => [
                    "name" => "Manchester City",
                    "slug" => "manchester-city",
                    "shortName" => "Man City",
                    "gender" => "M",
                    "sport" => [
                        "name" => "Football",
                        "slug" => "football",
                        "id" => 1
                    ],
                    "userCount" => 2814218,
                    "nameCode" => "MCI",
                    "disabled" => false,
                    "national" => false,
                    "type" => 0,
                    "id" => 17,
                    "country" => [
                        "alpha2" => "EN",
                        "name" => "England"
                    ],
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
                            "hi" => "मैनचेस्टर सिटी"
                        ],
                        "shortNameTranslation" => [
                            "ar" => "مان سيتي",
                            "hi" => "मैन सिटी"
                        ]
                    ]
                ],
                "titleHolderTitles" => 10,
                "mostTitles" => 20,
                "mostTitlesTeams" => [
                    [
                        "name" => "Manchester United",
                        "slug" => "manchester-united",
                        "shortName" => "Man Utd",
                        "gender" => "M",
                        "sport" => [
                            "name" => "Football",
                            "slug" => "football",
                            "id" => 1
                        ],
                        "userCount" => 2517292,
                        "nameCode" => "MUN",
                        "disabled" => false,
                        "national" => false,
                        "type" => 0,
                        "id" => 35,
                        "country" => [
                            "alpha2" => "EN",
                            "name" => "England"
                        ],
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
                                "hi" => "मैनचेस्टर यूनाइटेड"
                            ],
                            "shortNameTranslation" => [
                                "ar" => "مان يونايتد",
                                "hi" => "मैन यूनाइटेड"
                            ]
                        ]
                    ]
                ],
                "linkedUniqueTournaments" => [
                ],
                "hasRounds" => true,
                "hasGroups" => false,
                "hasPlayoffSeries" => false,
                "upperDivisions" => [
                ],
                "lowerDivisions" => [
                    [
                        "name" => "Championship",
                        "slug" => "championship",
                        "primaryColorHex" => "#20429a",
                        "secondaryColorHex" => "#ac944a",
                        "logo" => [
                            "md5" => "29a945d83732f069f92fb0986738b57f",
                            "id" => 294000
                        ],
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
                                "name" => "England"
                            ],
                            "flag" => "england",
                            "alpha2" => "EN"
                        ],
                        "tier" => 2,
                        "hasRounds" => true,
                        "hasGroups" => false,
                        "hasPlayoffSeries" => false,
                        "hasPerformanceGraphFeature" => true,
                        "periodLength" => [
                        ],
                        "id" => 18,
                        "country" => [
                        ],
                        "startDateTimestamp" => 1723161600,
                        "endDateTimestamp" => 1746230400,
                        "disabledHomeAwayStandings" => false,
                        "displayInverseHomeAwayTeams" => false
                    ]
                ],
                "hasPerformanceGraphFeature" => true,
                "periodLength" => [
                ],
                "id" => 17,
                "country" => [
                ],
                "startDateTimestamp" => 1723766400,
                "endDateTimestamp" => 1748131200,
                "disabledHomeAwayStandings" => false,
                "displayInverseHomeAwayTeams" => false,
                "fieldTranslations" => [
                    "nameTranslation" => [
                        "ar" => "الدوري الإنجليزي الممتاز",
                        "hi" => "प्रिमियर लीग"
                    ],
                    "shortNameTranslation" => [
                    ]
                ]
            ]
        ];


        return $jayParsedAry;
    }
}
