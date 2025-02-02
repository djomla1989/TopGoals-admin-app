<?php

namespace App\Jobs\Sync\Team;

use App\Builder\Player\PlayerBuilder;
use App\Builder\Team\TeamBuilder;
use App\Builder\Venue\VenueBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\Season;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class TeamInfoJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    protected Team $team;


    /**
     * Create a new job instance.
     */
    public function __construct(Team $team)
    {
        $this->team = $team;
    }

    public function uniqueId(): string
    {
        return  get_class($this->team) . '-info-' . $this->team->getId();
    }


    private function getUrl(): string
    {

        //Single team statistics
        return sprintf(
            'teams/data?team_id=%s',
            $this->team->getSourceId()
        );

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            if (false === config('sync.syncInactive') && $this->team->getIsActive() === false) {
                info('Team is inactive', ['team' => $this->team->id]);
                return;
            }

            $lastSync = $this->team->getLastSync();

            if (!empty($lastSync) && $this->getLastSyncComparatorDate()->lessThan($lastSync)) {
                info('Team last sync is less than a day', ['team' => $this->team->getId()]);
                return;
            }

            $url = $this->getUrl();
            $data = $this->getData($url);
            //$data = $this->getExampleData();

            $data = $data['data'] ?? [];

            if (empty($data)) {
                info('team missing data', ['team' => $this->team->getId()]);
                return;
            }

            $team = TeamBuilder::build($data, $this->team->sport);
            $team->save();

            if ($data['manager']) {
                $manager = PlayerBuilder::build($data['manager'], $this->team->sport, true);
                $manager->save();
                $team->setManager($manager)->save();
            }

            if ($data['venue']) {
                $venue = VenueBuilder::build($data['venue']);
                $venue->save();
                $team->setVenue($venue)->save();
            }

        } catch (\Exception $e) {
            info('Error syncing team info', [
                'team' => $this->team->getId(),
                'error' => $e->getMessage(). '::' . $e->getTraceAsString()
            ]);
            return;
        }
    }


    public function getExampleData(): array
    {
        $jayParsedAry = [
            "data" => [
                "name" => "Manchester City",
                "slug" => "manchester-city",
                "shortName" => "Man City",
                "gender" => "M",
                "sport" => [
                    "name" => "Football",
                    "slug" => "football",
                    "id" => 1
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
                        "alpha3" => "ENG",
                        "name" => "England",
                        "slug" => "england"
                    ],
                    "flag" => "england",
                    "alpha2" => "EN"
                ],
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
                        "userCount" => 1361324,
                        "hasPerformanceGraphFeature" => true,
                        "id" => 17,
                        "country" => [
                        ],
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
                "primaryUniqueTournament" => [
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
                    "userCount" => 1361324,
                    "hasPerformanceGraphFeature" => true,
                    "id" => 17,
                    "country" => [
                    ],
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
                "userCount" => 2909484,
                "manager" => [
                    "name" => "Pep Guardiola",
                    "slug" => "pep-guardiola",
                    "shortName" => "P. Guardiola",
                    "id" => 53463,
                    "country" => [
                        "alpha2" => "ES",
                        "alpha3" => "ESP",
                        "name" => "Spain",
                        "slug" => "spain"
                    ],
                    "fieldTranslations" => [
                        "nameTranslation" => [
                            "ar" => "بيب غوارديولا",
                            "hi" => "पेप गार्डियोला",
                            "bn" => "পেপ গার্দিওলা"
                        ],
                        "shortNameTranslation" => [
                            "ar" => "ب. غوارديولا",
                            "hi" => "पी. गार्डियोला",
                            "bn" => "পি. গার্দিওলা"
                        ]
                    ]
                ],
                "venue" => [
                    "city" => [
                        "name" => "Manchester"
                    ],
                    "venueCoordinates" => [
                        "latitude" => 53.483091,
                        "longitude" => -2.200252
                    ],
                    "hidden" => false,
                    "slug" => "etihad-stadium",
                    "name" => "Etihad Stadium",
                    "capacity" => 53400,
                    "id" => 606,
                    "country" => [
                        "alpha2" => "EN",
                        "alpha3" => "ENG",
                        "name" => "England",
                        "slug" => "england"
                    ],
                    "fieldTranslations" => [
                        "nameTranslation" => [
                            "ar" => "ملعب الإتحاد"
                        ],
                        "shortNameTranslation" => [
                        ]
                    ],
                    "stadium" => [
                        "name" => "Etihad Stadium",
                        "capacity" => 53400
                    ]
                ],
                "nameCode" => "MCI",
                "class" => 4,
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
                "fullName" => "Manchester City",
                "teamColors" => [
                    "primary" => "#66ccff",
                    "secondary" => "#ffffff",
                    "text" => "#ffffff"
                ],
                "foundationDateTimestamp" => -2811888000,
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
            ]
        ];


        return $jayParsedAry;
    }
}
