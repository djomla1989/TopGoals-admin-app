<?php

namespace App\Jobs\Sync\Season;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SyncSeasonTeamStatisticJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }

    public function getExampleData()
    {

        $arrayVar = [
            "data" => [
                "avgRating" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 7.1843813387424,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 7.1622309197652,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 7.0629558541267,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 7.0175196850394,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 6.9210325047801,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 6.9087221095335,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 6.8996204933586,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 6.8976833976834,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 6.8905511811024,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 6.8709615384615,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 6.8611538461539,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 6.8594285714286,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "avgRating" => 6.859126984127,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "avgRating" => 6.8390151515151,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 6.8031189083821,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 6.7889546351085,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "avgRating" => 6.7787276341948,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "avgRating" => 6.7498069498069,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "avgRating" => 6.7092843326886,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "avgRating" => 6.6814531548757,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "goalsScored" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 99,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 94,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 76,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 69,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 62,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 61,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 60,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 57,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 52,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 50,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 48,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 44,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 43,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 43,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsScored" => 42,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsScored" => 42,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsScored" => 38,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsScored" => 34,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsScored" => 34,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsScored" => 23,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "goalsConceded" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 26,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 26,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 33,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 40,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 43,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 44,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 46,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 48,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 51,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsConceded" => 53,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 54,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 56,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "goalsConceded" => 57,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 59,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 62,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 66,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "goalsConceded" => 67,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsConceded" => 77,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsConceded" => 79,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "goalsConceded" => 84,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "bigChances" => [
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 132,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 122,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 104,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 94,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 81,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 73,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 73,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 69,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 66,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChances" => 63,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 62,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 61,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 60,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 58,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChances" => 58,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChances" => 54,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChances" => 52,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 49,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChances" => 49,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChances" => 37,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "bigChancesMissed" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 65,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 60,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 59,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 53,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 50,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 42,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 41,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 40,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 40,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChancesMissed" => 39,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 37,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 37,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 37,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChancesMissed" => 37,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChancesMissed" => 37,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 33,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "bigChancesMissed" => 30,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 28,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "bigChancesMissed" => 27,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "bigChancesMissed" => 24,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "hitWoodwork" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 24,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 18,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "hitWoodwork" => 18,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 17,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "hitWoodwork" => 15,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 13,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 13,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 12,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 12,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 11,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 11,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "hitWoodwork" => 11,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 10,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 10,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 9,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 9,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "hitWoodwork" => 8,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 7,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "hitWoodwork" => 7,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "hitWoodwork" => 6,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "yellowCards" => [
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "yellowCards" => 101,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 80,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 80,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 80,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 76,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 73,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 68,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 68,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "yellowCards" => 68,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 64,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 63,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 63,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 63,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 61,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "yellowCards" => 60,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "yellowCards" => 56,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 55,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 50,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "yellowCards" => 49,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "yellowCards" => 42,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "redCards" => [
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 6,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 4,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 3,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 3,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "redCards" => 3,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "redCards" => 3,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "redCards" => 2,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "redCards" => 1,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "averageBallPossession" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 68.236842105263,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 63.210526315789,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 62.263157894737,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 54.605263157895,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 53.026315789474,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 52.736842105263,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "averageBallPossession" => 52.526315789474,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 52.184210526316,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 51.815789473684,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 51.157894736842,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 49.526315789474,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 47.710526315789,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 47.710526315789,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 46.447368421053,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "averageBallPossession" => 44.526315789474,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "averageBallPossession" => 42.5,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "averageBallPossession" => 40.315789473684,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 40,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "averageBallPossession" => 39.763157894737,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "averageBallPossession" => 39.736842105263,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "accuratePasses" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 23434,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 20200,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 20032,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 16291,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 15757,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 15385,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 15254,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 15195,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 14236,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 13903,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 13362,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accuratePasses" => 12865,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 11868,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 11717,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accuratePasses" => 11208,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accuratePasses" => 10762,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accuratePasses" => 9509,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 9493,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accuratePasses" => 9329,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accuratePasses" => 8522,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "accurateLongBalls" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 1020,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 993,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 899,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 845,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 843,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 833,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 751,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 733,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateLongBalls" => 721,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateLongBalls" => 717,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 678,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateLongBalls" => 667,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 648,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateLongBalls" => 639,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 609,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 602,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 602,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateLongBalls" => 582,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 562,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateLongBalls" => 553,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "accurateCrosses" => [
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 221,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 186,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 168,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 164,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateCrosses" => 161,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 157,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 156,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 156,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 151,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 151,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 151,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 151,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 150,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 149,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 146,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateCrosses" => 146,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "accurateCrosses" => 137,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateCrosses" => 127,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "accurateCrosses" => 121,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "accurateCrosses" => 98,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "shots" => [
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 729,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 713,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 592,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 589,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 508,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 491,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 489,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shots" => 485,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 482,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 464,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 449,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 449,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 442,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 437,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shots" => 435,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 412,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shots" => 407,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shots" => 402,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shots" => 399,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shots" => 373,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "shotsOnTarget" => [
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 256,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 254,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 211,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 198,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 198,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 187,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 170,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 169,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 162,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 157,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 155,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shotsOnTarget" => 154,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 152,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 149,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 147,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "shotsOnTarget" => 138,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "shotsOnTarget" => 136,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shotsOnTarget" => 127,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shotsOnTarget" => 125,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "shotsOnTarget" => 109,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "successfulDribbles" => [
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 450,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 425,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "successfulDribbles" => 395,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 383,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 375,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 368,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 364,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 359,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 350,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 343,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "successfulDribbles" => 339,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 337,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 333,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 319,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 317,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 306,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "successfulDribbles" => 298,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "successfulDribbles" => 297,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "successfulDribbles" => 262,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "successfulDribbles" => 258,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "tackles" => [
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "tackles" => 786,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 705,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 690,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 673,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 668,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 659,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 636,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 634,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 621,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "tackles" => 614,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "tackles" => 614,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 607,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 602,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 598,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "tackles" => 589,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 585,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 554,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 540,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "tackles" => 534,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "tackles" => 498,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "interceptions" => [
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 446,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "interceptions" => 444,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "interceptions" => 411,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "interceptions" => 395,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 393,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 389,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "interceptions" => 381,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 374,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 367,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 365,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 360,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 358,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 355,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 347,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 341,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 340,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 340,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "interceptions" => 333,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 296,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "interceptions" => 279,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "clearances" => [
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "clearances" => 866,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "clearances" => 832,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "clearances" => 816,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 809,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 775,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 771,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 761,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 758,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 755,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 743,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 731,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 727,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 684,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 673,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 636,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "clearances" => 629,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 616,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "clearances" => 604,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 499,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "clearances" => 368,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "corners" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 316,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 282,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 241,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 233,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 208,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 200,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 200,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 197,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 196,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 193,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 185,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "corners" => 183,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 175,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "corners" => 170,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 168,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "corners" => 165,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 161,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "corners" => 161,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "corners" => 160,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "corners" => 159,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "fouls" => [
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "fouls" => 469,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "fouls" => 442,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 414,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 409,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 402,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 401,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 396,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "fouls" => 394,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 393,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 392,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 386,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 371,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 368,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 366,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 365,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 363,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 356,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "fouls" => 356,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "fouls" => 323,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "fouls" => 321,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "penaltyGoals" => [
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 8,
                            "penaltiesTaken" => 9,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 7,
                            "penaltiesTaken" => 8,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 7,
                            "penaltiesTaken" => 9,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 6,
                            "penaltiesTaken" => 6,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 6,
                            "penaltiesTaken" => 7,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 6,
                            "penaltiesTaken" => 8,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 5,
                            "penaltiesTaken" => 5,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltyGoals" => 5,
                            "penaltiesTaken" => 5,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 5,
                            "penaltiesTaken" => 8,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 4,
                            "penaltiesTaken" => 4,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 4,
                            "penaltiesTaken" => 6,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 4,
                            "penaltiesTaken" => 7,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 3,
                            "penaltiesTaken" => 3,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 3,
                            "penaltiesTaken" => 3,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltyGoals" => 3,
                            "penaltiesTaken" => 3,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 3,
                            "penaltiesTaken" => 5,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltyGoals" => 2,
                            "penaltiesTaken" => 2,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltyGoals" => 1,
                            "penaltiesTaken" => 1,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltyGoals" => 1,
                            "penaltiesTaken" => 2,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltyGoals" => 1,
                            "penaltiesTaken" => 2,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "penaltyGoalsConceded" => [
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 10,
                            "penaltyGoalsConceded" => 9,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltiesCommited" => 12,
                            "penaltyGoalsConceded" => 9,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 9,
                            "penaltyGoalsConceded" => 7,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 6,
                            "penaltyGoalsConceded" => 6,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltiesCommited" => 7,
                            "penaltyGoalsConceded" => 6,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 5,
                            "penaltyGoalsConceded" => 5,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltiesCommited" => 5,
                            "penaltyGoalsConceded" => 5,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "penaltiesCommited" => 5,
                            "penaltyGoalsConceded" => 5,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 6,
                            "penaltyGoalsConceded" => 5,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 6,
                            "penaltyGoalsConceded" => 5,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 6,
                            "penaltyGoalsConceded" => 4,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 4,
                            "penaltyGoalsConceded" => 3,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 4,
                            "penaltyGoalsConceded" => 3,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 5,
                            "penaltyGoalsConceded" => 3,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 2,
                            "penaltyGoalsConceded" => 2,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 2,
                            "penaltyGoalsConceded" => 2,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 2,
                            "penaltyGoalsConceded" => 2,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "penaltiesCommited" => 6,
                            "penaltyGoalsConceded" => 2,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 1,
                            "penaltyGoalsConceded" => 1,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "penaltiesCommited" => 0,
                            "penaltyGoalsConceded" => 0,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
                "cleanSheets" => [
                    [
                        "team" => [
                            "name" => "Manchester City",
                            "slug" => "manchester-city",
                            "shortName" => "Manchester City",
                            "gender" => "M",
                            "userCount" => 2819772,
                            "national" => false,
                            "type" => 0,
                            "id" => 17,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 21,
                            "id" => 6278,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Liverpool",
                            "slug" => "liverpool",
                            "shortName" => "Liverpool",
                            "gender" => "M",
                            "userCount" => 2525477,
                            "national" => false,
                            "type" => 0,
                            "id" => 44,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 21,
                            "id" => 6232,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Chelsea",
                            "slug" => "chelsea",
                            "shortName" => "Chelsea",
                            "gender" => "M",
                            "userCount" => 2081992,
                            "national" => false,
                            "type" => 0,
                            "id" => 38,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 16,
                            "id" => 6211,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Tottenham Hotspur",
                            "slug" => "tottenham-hotspur",
                            "shortName" => "Tottenham Hotspur",
                            "gender" => "M",
                            "userCount" => 1298043,
                            "national" => false,
                            "type" => 0,
                            "id" => 33,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 16,
                            "id" => 6277,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Arsenal",
                            "slug" => "arsenal",
                            "shortName" => "Arsenal",
                            "gender" => "M",
                            "userCount" => 2283506,
                            "national" => false,
                            "type" => 0,
                            "id" => 42,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 13,
                            "id" => 6194,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Crystal Palace",
                            "slug" => "crystal-palace",
                            "shortName" => "Crystal Palace",
                            "gender" => "M",
                            "userCount" => 397426,
                            "national" => false,
                            "type" => 0,
                            "id" => 7,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 12,
                            "id" => 6212,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Aston Villa",
                            "slug" => "aston-villa",
                            "shortName" => "Aston Villa",
                            "gender" => "M",
                            "userCount" => 847630,
                            "national" => false,
                            "type" => 0,
                            "id" => 40,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 11,
                            "id" => 6220,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brighton & Hove Albion",
                            "slug" => "brighton-and-hove-albion",
                            "shortName" => "Brighton & Hove Albion",
                            "gender" => "M",
                            "userCount" => 610514,
                            "national" => false,
                            "type" => 0,
                            "id" => 30,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 11,
                            "id" => 6218,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Wolverhampton",
                            "slug" => "wolverhampton",
                            "shortName" => "Wolverhampton",
                            "gender" => "M",
                            "userCount" => 405824,
                            "national" => false,
                            "type" => 0,
                            "id" => 3,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 11,
                            "id" => 6216,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Brentford",
                            "slug" => "brentford",
                            "shortName" => "Brentford",
                            "gender" => "M",
                            "userCount" => 359614,
                            "national" => false,
                            "type" => 0,
                            "id" => 50,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 9,
                            "id" => 6193,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Burnley",
                            "slug" => "burnley",
                            "shortName" => "Burnley",
                            "gender" => "M",
                            "userCount" => 188932,
                            "national" => false,
                            "type" => 0,
                            "id" => 6,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "ru" => "Бернли",
                                    "hi" => "बर्नली",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيرنلي",
                                    "hi" => "बर्नली",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "cleanSheets" => 9,
                            "id" => 6217,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Manchester United",
                            "slug" => "manchester-united",
                            "shortName" => "Manchester United",
                            "gender" => "M",
                            "userCount" => 2530502,
                            "national" => false,
                            "type" => 0,
                            "id" => 35,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 8,
                            "id" => 6199,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Newcastle United",
                            "slug" => "newcastle-united",
                            "shortName" => "Newcastle United",
                            "gender" => "M",
                            "userCount" => 879462,
                            "national" => false,
                            "type" => 0,
                            "id" => 39,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 8,
                            "id" => 6269,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "West Ham United",
                            "slug" => "west-ham-united",
                            "shortName" => "West Ham United",
                            "gender" => "M",
                            "userCount" => 663903,
                            "national" => false,
                            "type" => 0,
                            "id" => 37,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
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
                        "statistics" => [
                            "cleanSheets" => 8,
                            "id" => 6270,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Everton",
                            "slug" => "everton",
                            "shortName" => "Everton",
                            "gender" => "M",
                            "userCount" => 455577,
                            "national" => false,
                            "type" => 0,
                            "id" => 48,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 8,
                            "id" => 6213,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Southampton",
                            "slug" => "southampton",
                            "shortName" => "Southampton",
                            "gender" => "M",
                            "userCount" => 210201,
                            "national" => false,
                            "type" => 0,
                            "id" => 45,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 8,
                            "id" => 6214,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leicester City",
                            "slug" => "leicester-city",
                            "shortName" => "Leicester City",
                            "gender" => "M",
                            "userCount" => 526882,
                            "national" => false,
                            "type" => 0,
                            "id" => 31,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
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
                        "statistics" => [
                            "cleanSheets" => 7,
                            "id" => 6215,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Norwich City",
                            "slug" => "norwich-city",
                            "shortName" => "Norwich City",
                            "gender" => "M",
                            "userCount" => 73933,
                            "national" => false,
                            "type" => 0,
                            "id" => 263,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نورويتش سيتي",
                                    "ru" => "Норвич Сити",
                                    "hi" => "नॉरिच सिटी",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "نورويتش",
                                    "hi" => "नॉरिच",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "cleanSheets" => 6,
                            "id" => 6231,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Leeds United",
                            "slug" => "leeds-united",
                            "shortName" => "Leeds United",
                            "gender" => "M",
                            "userCount" => 262161,
                            "national" => false,
                            "type" => 0,
                            "id" => 34,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ليدز يونايتد",
                                    "ru" => "Лидс",
                                    "hi" => "लीड्स यूनाइटेड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ليدز",
                                    "hi" => "लीड्स",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "cleanSheets" => 5,
                            "id" => 6200,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                    [
                        "team" => [
                            "name" => "Watford",
                            "slug" => "watford",
                            "shortName" => "Watford",
                            "gender" => "M",
                            "userCount" => 66717,
                            "national" => false,
                            "type" => 0,
                            "id" => 24,
                            "entityType" => "team",
                            "teamColors" => [
                                "primary" => "#374df5",
                                "secondary" => "#374df5",
                                "text" => "#ffffff",
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "واتفورد",
                                    "ru" => "Уотфорд",
                                    "hi" => "वॉटफोर्ड",
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "واتفورد",
                                    "hi" => "वॉटफर्ड",
                                ],
                            ],
                        ],
                        "statistics" => [
                            "cleanSheets" => 4,
                            "id" => 6219,
                            "matches" => 38,
                            "awardedMatches" => 0,
                        ],
                    ],
                ],
            ],
        ];

        return $arrayVar;
    }
}
