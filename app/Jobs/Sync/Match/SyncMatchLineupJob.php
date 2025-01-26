<?php

namespace App\Jobs\Sync\Match;

use App\Builder\Match\MatchLineupBuilder;
use App\Builder\Match\MatchLineupPlayerBuilder;
use App\Builder\Player\PlayerBuilder;
use App\Builder\Player\PlayerDetailBuilder;
use App\Jobs\Sync\AbstractSyncJob;
use App\Models\MatchEvent;
use App\Models\Team;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\MatchLineup;

class SyncMatchLineupJob extends AbstractSyncJob implements ShouldQueue, ShouldBeUnique
{
    use Queueable;

    protected MatchEvent $match;

    /**
     * Create a new job instance.
     */
    public function __construct(MatchEvent $match)
    {
        $this->match = $match;
    }

    public function uniqueId(): string
    {
        return get_class($this->match) . '-lineup-' . $this->match->id;
    }

    public function failed(\Throwable $exception): void
    {
        info('Match lineup data sync failed', [
            'match' => $this->match->id,
            'exception' => $exception->getMessage()
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            $url = $this->getUrl($this->match);
            //$data = $this->getData($url);
            $data = $this->getExampleData();
            $data = $data['data'] ?? [];

            if (empty($data)) {
                info('Match lineup is empty', ['season' => $this->match->id]);
                return;
            }

            $homeTeamLineup = $this->createTeamLineup($this->match->homeTeam, $data['home']);

            $awayTeamLineup = $this->createTeamLineup($this->match->awayTeam, $data['away']);

            $this->addPlayersToLineup($homeTeamLineup, $data['home']['players']);
            $this->addPlayersToLineup($awayTeamLineup, $data['away']['players']);

            //Add missing players to lineups as missing
            $this->addPlayersToLineup($homeTeamLineup, $data['home']['missingPlayers']);
            $this->addPlayersToLineup($awayTeamLineup, $data['away']['missingPlayers']);

        } catch (\Exception $e) {
            info('Match lineup data sync failed', [
                'match' => $this->match->id,
                'exception' => $e->getMessage()
            ]);
        }

    }

    private function createTeamLineup(Team $team, array $lineupData): MatchLineup
    {
        $teamLineup = MatchLineupBuilder::build($lineupData, $this->match, $team);
        $teamLineup->save();

        return $teamLineup;
    }

    private function addPlayersToLineup(MatchLineup $teamLineup, array $players): void
    {
        foreach ($players as $playerData) {
            $player = PlayerBuilder::build($playerData['player'], $this->match->sport);
            $player->save();

            $playerDetails = PlayerDetailBuilder::build($playerData['player'], $player);
            $playerDetails->save();

            $playerLineup = MatchLineupPlayerBuilder::build(
                $playerData,
                $teamLineup,
                $player,
                !empty($playerData['reason']),//TODO: this can be 1 or 11 or more... maybe rename colum to `missing_reason`
                $playerData['type'] ?? null//TODO: add missing reason
            );
            $playerLineup->save();
        }
    }

    public function getUrl(MatchEvent $match): string
    {
        return 'events/lineups?event_id=' . $match->getSourceId();
    }

    public function getExampleData(): array
    {

        $arrayVar = [
            "data" => [
                "confirmed" => true,
                "home" => [
                    "players" => [
                        [
                            "player" => [
                                "name" => "Yann Sommer",
                                "slug" => "yann-sommer",
                                "shortName" => "Y. Sommer",
                                "position" => "G",
                                "jerseyNumber" => "1",
                                "height" => 183,
                                "userCount" => 9530,
                                "id" => 16206,
                                "country" => [
                                    "alpha2" => "CH",
                                    "alpha3" => "CHE",
                                    "name" => "Switzerland",
                                    "slug" => "switzerland",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 598320000,
                                "proposedMarketValueRaw" => [
                                    "value" => 3700000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "يان سومر"],
                                    "shortNameTranslation" => ["ar" => "ي. سومر"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 1,
                            "jerseyNumber" => "1",
                            "position" => "G",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 50,
                                "accuratePass" => 45,
                                "totalLongBalls" => 6,
                                "accurateLongBalls" => 3,
                                "savedShotsFromInsideTheBox" => 1,
                                "saves" => 1,
                                "minutesPlayed" => 90,
                                "touches" => 52,
                                "rating" => 6.9,
                                "possessionLostCtrl" => 5,
                                "ratingVersions" => [
                                    "original" => 6.9,
                                    "alternative" => 7.2,
                                ],
                                "goalsPrevented" => 0.0517,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Benjamin Pavard",
                                "slug" => "benjamin-pavard",
                                "shortName" => "B. Pavard",
                                "position" => "D",
                                "jerseyNumber" => "28",
                                "height" => 186,
                                "userCount" => 9223,
                                "id" => 787505,
                                "country" => [
                                    "alpha2" => "FR",
                                    "alpha3" => "FRA",
                                    "name" => "France",
                                    "slug" => "france",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 827971200,
                                "proposedMarketValueRaw" => [
                                    "value" => 42000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "بافار, بنجامين"],
                                    "shortNameTranslation" => ["ar" => "ب. بافار"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 28,
                            "jerseyNumber" => "28",
                            "position" => "D",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 45,
                                "accuratePass" => 43,
                                "totalLongBalls" => 2,
                                "accurateLongBalls" => 2,
                                "goalAssist" => 1,
                                "totalCross" => 1,
                                "aerialLost" => 1,
                                "aerialWon" => 1,
                                "duelLost" => 3,
                                "duelWon" => 6,
                                "challengeLost" => 1,
                                "totalClearance" => 1,
                                "outfielderBlock" => 1,
                                "interceptionWon" => 1,
                                "totalTackle" => 4,
                                "errorLeadToAShot" => 1,
                                "wasFouled" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 90,
                                "touches" => 55,
                                "rating" => 7.4,
                                "possessionLostCtrl" => 3,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 7.4,
                                    "alternative" => 7.4,
                                ],
                                "expectedAssists" => 0.0255717,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Stefan de Vrij",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "stefan-de-vrij",
                                "shortName" => "S. de Vrij",
                                "position" => "D",
                                "jerseyNumber" => "6",
                                "height" => 188,
                                "userCount" => 4431,
                                "id" => 91046,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 697248000,
                                "proposedMarketValueRaw" => [
                                    "value" => 6500000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ستيفان دو فري"],
                                    "shortNameTranslation" => ["ar" => "س. د. فري"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 6,
                            "jerseyNumber" => "6",
                            "position" => "D",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 69,
                                "accuratePass" => 66,
                                "totalLongBalls" => 2,
                                "accurateLongBalls" => 1,
                                "aerialLost" => 1,
                                "aerialWon" => 2,
                                "duelLost" => 1,
                                "duelWon" => 3,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "totalClearance" => 5,
                                "minutesPlayed" => 90,
                                "touches" => 77,
                                "rating" => 7.1,
                                "possessionLostCtrl" => 3,
                                "ratingVersions" => [
                                    "original" => 7.1,
                                    "alternative" => 7.2,
                                ],
                                "expectedAssists" => 0.006858,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Alessandro Bastoni",
                                "slug" => "alessandro-bastoni",
                                "shortName" => "A. Bastoni",
                                "position" => "D",
                                "jerseyNumber" => "95",
                                "height" => 190,
                                "userCount" => 8309,
                                "id" => 826188,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 923961600,
                                "proposedMarketValueRaw" => [
                                    "value" => 70000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "اليساندرو باستوني"],
                                    "shortNameTranslation" => ["ar" => "ا. باستوني"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 95,
                            "jerseyNumber" => "95",
                            "position" => "D",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 83,
                                "accuratePass" => 74,
                                "totalLongBalls" => 9,
                                "accurateLongBalls" => 7,
                                "totalCross" => 1,
                                "aerialLost" => 3,
                                "aerialWon" => 4,
                                "duelLost" => 9,
                                "duelWon" => 7,
                                "challengeLost" => 3,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "bigChanceCreated" => 1,
                                "totalClearance" => 2,
                                "interceptionWon" => 2,
                                "totalTackle" => 1,
                                "wasFouled" => 1,
                                "fouls" => 3,
                                "minutesPlayed" => 90,
                                "touches" => 98,
                                "rating" => 7.4,
                                "possessionLostCtrl" => 12,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 7.4,
                                    "alternative" => 7.3,
                                ],
                                "expectedAssists" => 0.050533,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Matteo Darmian",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "matteo-darmian",
                                "shortName" => "M. Darmian",
                                "position" => "M",
                                "jerseyNumber" => "36",
                                "height" => 182,
                                "userCount" => 3393,
                                "id" => 19352,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 628560000,
                                "proposedMarketValueRaw" => [
                                    "value" => 3800000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "دارميان ماتيو"],
                                    "shortNameTranslation" => ["ar" => "د. ماتيو"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 36,
                            "jerseyNumber" => "36",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 32,
                                "accuratePass" => 29,
                                "totalLongBalls" => 4,
                                "accurateLongBalls" => 2,
                                "totalCross" => 1,
                                "duelLost" => 3,
                                "duelWon" => 2,
                                "challengeLost" => 1,
                                "totalContest" => 1,
                                "bigChanceMissed" => 1,
                                "onTargetScoringAttempt" => 2,
                                "goals" => 1,
                                "totalClearance" => 3,
                                "interceptionWon" => 1,
                                "totalTackle" => 2,
                                "fouls" => 1,
                                "minutesPlayed" => 45,
                                "touches" => 48,
                                "rating" => 7,
                                "possessionLostCtrl" => 6,
                                "expectedGoals" => 0.4376,
                                "ratingVersions" => [
                                    "original" => 7,
                                    "alternative" => 7,
                                ],
                                "expectedAssists" => 0.00873073,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Nicolò Barella",
                                "slug" => "nicolo-barella",
                                "shortName" => "N. Barella",
                                "position" => "M",
                                "jerseyNumber" => "23",
                                "height" => 175,
                                "userCount" => 17554,
                                "id" => 363856,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 855273600,
                                "proposedMarketValueRaw" => [
                                    "value" => 87000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "نيكولو باريلا"],
                                    "shortNameTranslation" => ["ar" => "ن. باريلا"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 23,
                            "jerseyNumber" => "23",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 74,
                                "accuratePass" => 64,
                                "totalLongBalls" => 10,
                                "accurateLongBalls" => 5,
                                "totalCross" => 1,
                                "duelLost" => 1,
                                "duelWon" => 1,
                                "totalContest" => 1,
                                "shotOffTarget" => 1,
                                "wasFouled" => 1,
                                "totalOffside" => 1,
                                "minutesPlayed" => 90,
                                "touches" => 82,
                                "rating" => 6.7,
                                "possessionLostCtrl" => 14,
                                "expectedGoals" => 0.014,
                                "ratingVersions" => [
                                    "original" => 6.7,
                                    "alternative" => 6.7,
                                ],
                                "expectedAssists" => 0.0178941,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Kristjan Asllani",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "kristjan-asllani",
                                "shortName" => "K. Asllani",
                                "position" => "M",
                                "jerseyNumber" => "21",
                                "height" => 179,
                                "userCount" => 3742,
                                "id" => 996820,
                                "country" => [
                                    "alpha2" => "AL",
                                    "alpha3" => "ALB",
                                    "name" => "Albania",
                                    "slug" => "albania",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1015632000,
                                "proposedMarketValueRaw" => [
                                    "value" => 18500000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "كريستجان أسلاني"],
                                    "shortNameTranslation" => ["ar" => "ك. أسلاني"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 21,
                            "jerseyNumber" => "21",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 77,
                                "accuratePass" => 75,
                                "totalLongBalls" => 7,
                                "accurateLongBalls" => 5,
                                "totalCross" => 2,
                                "duelLost" => 3,
                                "duelWon" => 4,
                                "challengeLost" => 2,
                                "totalContest" => 1,
                                "shotOffTarget" => 1,
                                "interceptionWon" => 1,
                                "totalTackle" => 1,
                                "wasFouled" => 3,
                                "minutesPlayed" => 90,
                                "touches" => 88,
                                "rating" => 6.9,
                                "possessionLostCtrl" => 5,
                                "expectedGoals" => 0.0564,
                                "ratingVersions" => [
                                    "original" => 6.9,
                                    "alternative" => 6.9,
                                ],
                                "expectedAssists" => 0.012403,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Henrikh Mkhitaryan",
                                "slug" => "henrikh-mkhitaryan",
                                "shortName" => "H. Mkhitaryan",
                                "position" => "M",
                                "jerseyNumber" => "22",
                                "height" => 178,
                                "userCount" => 7274,
                                "id" => 37151,
                                "country" => [
                                    "alpha2" => "AM",
                                    "alpha3" => "ARM",
                                    "name" => "Armenia",
                                    "slug" => "armenia",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 601344000,
                                "proposedMarketValueRaw" => [
                                    "value" => 4800000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "مخيتاريان, هنريخ"],
                                    "shortNameTranslation" => ["ar" => "ه. مخيتاريان"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 22,
                            "jerseyNumber" => "22",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 34,
                                "accuratePass" => 31,
                                "totalLongBalls" => 3,
                                "accurateLongBalls" => 3,
                                "goalAssist" => 1,
                                "duelLost" => 1,
                                "bigChanceCreated" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 62,
                                "touches" => 38,
                                "rating" => 7.2,
                                "possessionLostCtrl" => 4,
                                "keyPass" => 2,
                                "ratingVersions" => [
                                    "original" => 7.2,
                                    "alternative" => 7.1,
                                ],
                                "expectedAssists" => 0.0200273,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Federico Dimarco",
                                "slug" => "federico-dimarco",
                                "shortName" => "F. Dimarco",
                                "position" => "M",
                                "jerseyNumber" => "32",
                                "height" => 174,
                                "userCount" => 9383,
                                "id" => 284361,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 879120000,
                                "proposedMarketValueRaw" => [
                                    "value" => 58000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "فيديريكو دي ماركو"],
                                    "shortNameTranslation" => ["ar" => "ف. د. ماركو"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 32,
                            "jerseyNumber" => "32",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 31,
                                "accuratePass" => 25,
                                "totalLongBalls" => 5,
                                "accurateLongBalls" => 3,
                                "totalCross" => 5,
                                "accurateCross" => 1,
                                "aerialLost" => 2,
                                "duelLost" => 3,
                                "duelWon" => 1,
                                "dispossessed" => 1,
                                "onTargetScoringAttempt" => 2,
                                "blockedScoringAttempt" => 2,
                                "goals" => 1,
                                "totalClearance" => 1,
                                "totalTackle" => 1,
                                "minutesPlayed" => 69,
                                "touches" => 49,
                                "rating" => 7.5,
                                "possessionLostCtrl" => 13,
                                "expectedGoals" => 0.3745,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 7.5,
                                    "alternative" => 7.4,
                                ],
                                "expectedAssists" => 0.0128688,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Marko Arnautović",
                                "slug" => "marko-arnautovic",
                                "shortName" => "M. Arnautović",
                                "position" => "F",
                                "jerseyNumber" => "8",
                                "height" => 192,
                                "userCount" => 5283,
                                "id" => 21927,
                                "country" => [
                                    "alpha2" => "AT",
                                    "alpha3" => "AUT",
                                    "name" => "Austria",
                                    "slug" => "austria",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 608947200,
                                "proposedMarketValueRaw" => [
                                    "value" => 3700000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ارنوتوفيتش ماركو"],
                                    "shortNameTranslation" => ["ar" => "ا. ماركو"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 8,
                            "jerseyNumber" => "8",
                            "position" => "F",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 28,
                                "accuratePass" => 24,
                                "totalLongBalls" => 1,
                                "accurateLongBalls" => 1,
                                "aerialLost" => 1,
                                "duelLost" => 2,
                                "duelWon" => 4,
                                "dispossessed" => 1,
                                "totalTackle" => 3,
                                "wasFouled" => 1,
                                "minutesPlayed" => 90,
                                "touches" => 39,
                                "rating" => 6.9,
                                "possessionLostCtrl" => 9,
                                "ratingVersions" => [
                                    "original" => 6.9,
                                    "alternative" => 6.8,
                                ],
                                "expectedAssists" => 0.0205199,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Lautaro Martínez",
                                "slug" => "lautaro-martinez",
                                "shortName" => "L. Martínez",
                                "position" => "F",
                                "jerseyNumber" => "10",
                                "height" => 175,
                                "userCount" => 107039,
                                "id" => 823984,
                                "country" => [
                                    "alpha2" => "AR",
                                    "alpha3" => "ARG",
                                    "name" => "Argentina",
                                    "slug" => "argentina",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 872208000,
                                "proposedMarketValueRaw" => [
                                    "value" => 94000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "وتارو مارتينيز"],
                                    "shortNameTranslation" => ["ar" => "و. مارتينيز"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 10,
                            "jerseyNumber" => "10",
                            "position" => "F",
                            "substitute" => false,
                            "captain" => true,
                            "statistics" => [
                                "totalPass" => 24,
                                "accuratePass" => 12,
                                "totalLongBalls" => 3,
                                "accurateLongBalls" => 1,
                                "aerialLost" => 2,
                                "aerialWon" => 1,
                                "duelLost" => 7,
                                "duelWon" => 3,
                                "dispossessed" => 3,
                                "totalContest" => 1,
                                "bigChanceCreated" => 1,
                                "bigChanceMissed" => 2,
                                "shotOffTarget" => 2,
                                "onTargetScoringAttempt" => 2,
                                "hitWoodwork" => 1,
                                "goals" => 1,
                                "totalTackle" => 1,
                                "wasFouled" => 1,
                                "fouls" => 1,
                                "totalOffside" => 1,
                                "minutesPlayed" => 68,
                                "touches" => 40,
                                "rating" => 6.9,
                                "possessionLostCtrl" => 17,
                                "expectedGoals" => 1.0642,
                                "keyPass" => 3,
                                "penaltyMiss" => 1,
                                "ratingVersions" => [
                                    "original" => 6.9,
                                    "alternative" => 6.8,
                                ],
                                "expectedAssists" => 0.115486,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Denzel Dumfries",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "denzel-dumfries",
                                "shortName" => "D. Dumfries",
                                "position" => "M",
                                "jerseyNumber" => "2",
                                "height" => 189,
                                "userCount" => 8420,
                                "id" => 759520,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 829785600,
                                "proposedMarketValueRaw" => [
                                    "value" => 21000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "دينزل دومفريز"],
                                    "shortNameTranslation" => ["ar" => "د. دومفريز"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 2,
                            "jerseyNumber" => "2",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 10,
                                "accuratePass" => 9,
                                "duelLost" => 1,
                                "duelWon" => 2,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "blockedScoringAttempt" => 1,
                                "totalClearance" => 1,
                                "interceptionWon" => 2,
                                "wasFouled" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 45,
                                "touches" => 19,
                                "rating" => 7,
                                "possessionLostCtrl" => 2,
                                "expectedGoals" => 0.0372,
                                "ratingVersions" => [
                                    "original" => 7,
                                    "alternative" => 6.8,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Davide Frattesi",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "davide-frattesi",
                                "shortName" => "D. Frattesi",
                                "position" => "M",
                                "jerseyNumber" => "16",
                                "height" => 178,
                                "userCount" => 4401,
                                "id" => 835600,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 937958400,
                                "proposedMarketValueRaw" => [
                                    "value" => 29000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "دافيد فراتيسي"],
                                    "shortNameTranslation" => ["ar" => "د. فراتيسي"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 16,
                            "jerseyNumber" => "16",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 3,
                                "accuratePass" => 3,
                                "duelLost" => 2,
                                "dispossessed" => 2,
                                "onTargetScoringAttempt" => 1,
                                "goals" => 1,
                                "minutesPlayed" => 11,
                                "touches" => 7,
                                "rating" => 7.4,
                                "possessionLostCtrl" => 2,
                                "expectedGoals" => 0.2481,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 7.4,
                                    "alternative" => 7.2,
                                ],
                                "expectedAssists" => 0.00835503,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Alexis Sánchez",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "alexis-sanchez",
                                "shortName" => "A. Sánchez",
                                "position" => "F",
                                "jerseyNumber" => "7",
                                "height" => 169,
                                "userCount" => 23784,
                                "id" => 34120,
                                "country" => [
                                    "alpha2" => "CL",
                                    "alpha3" => "CHL",
                                    "name" => "Chile",
                                    "slug" => "chile",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 598492800,
                                "proposedMarketValueRaw" => [
                                    "value" => 2200000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "سانشيز, ألكسيس"],
                                    "shortNameTranslation" => ["ar" => "أ. سانشيز"],
                                ],
                            ],
                            "teamId" => 2695,
                            "shirtNumber" => 70,
                            "jerseyNumber" => "70",
                            "position" => "F",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 15,
                                "accuratePass" => 14,
                                "goalAssist" => 1,
                                "totalCross" => 1,
                                "duelLost" => 1,
                                "duelWon" => 3,
                                "bigChanceCreated" => 1,
                                "wasFouled" => 3,
                                "fouls" => 1,
                                "minutesPlayed" => 22,
                                "touches" => 19,
                                "rating" => 7.4,
                                "possessionLostCtrl" => 2,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 7.4,
                                    "alternative" => 7.3,
                                ],
                                "expectedAssists" => 0.21035,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Carlos Augusto",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "carlos-augusto",
                                "shortName" => "C. Augusto",
                                "position" => "D",
                                "jerseyNumber" => "30",
                                "height" => 184,
                                "userCount" => 3359,
                                "id" => 929199,
                                "country" => [
                                    "alpha2" => "BR",
                                    "alpha3" => "BRA",
                                    "name" => "Brazil",
                                    "slug" => "brazil",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 915667200,
                                "proposedMarketValueRaw" => [
                                    "value" => 21000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "أوغوستو, كارلوس"],
                                    "shortNameTranslation" => ["ar" => "ك. أوغوستو"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 30,
                            "jerseyNumber" => "30",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 6,
                                "accuratePass" => 6,
                                "totalCross" => 2,
                                "aerialLost" => 1,
                                "duelLost" => 3,
                                "challengeLost" => 1,
                                "dispossessed" => 1,
                                "blockedScoringAttempt" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 21,
                                "touches" => 11,
                                "rating" => 6.4,
                                "possessionLostCtrl" => 4,
                                "expectedGoals" => 0.034,
                                "ratingVersions" => [
                                    "original" => 6.4,
                                    "alternative" => 6.2,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Davy Klaassen",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "davy-klaassen",
                                "shortName" => "D. Klaassen",
                                "position" => "M",
                                "jerseyNumber" => "18",
                                "height" => 179,
                                "userCount" => 1466,
                                "id" => 97410,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 730252800,
                                "proposedMarketValueRaw" => [
                                    "value" => 4099999,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "كلاسن, دافي"],
                                    "shortNameTranslation" => ["ar" => "د. كلاسن"],
                                ],
                            ],
                            "teamId" => 2953,
                            "shirtNumber" => 14,
                            "jerseyNumber" => "14",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 9,
                                "accuratePass" => 9,
                                "interceptionWon" => 1,
                                "minutesPlayed" => 17,
                                "touches" => 10,
                                "rating" => 6.7,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 6.7,
                                    "alternative" => 6.7,
                                ],
                                "expectedAssists" => 0.0147688,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Raffaele Di Gennaro",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "raffaele-di-gennaro",
                                "shortName" => "R. D. Gennaro",
                                "position" => "G",
                                "jerseyNumber" => "12",
                                "height" => 188,
                                "userCount" => 704,
                                "id" => 301162,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 749606400,
                                "proposedMarketValueRaw" => [
                                    "value" => 325000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "رافاييلي ديجينارو"],
                                    "shortNameTranslation" => ["ar" => "ر. ديجينارو"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 12,
                            "jerseyNumber" => "12",
                            "position" => "G",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Emil Audero",
                                "slug" => "emil-audero",
                                "shortName" => "E. Audero",
                                "position" => "G",
                                "jerseyNumber" => "1",
                                "height" => 190,
                                "userCount" => 1046,
                                "id" => 318603,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 853545600,
                                "proposedMarketValueRaw" => [
                                    "value" => 4800000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "إميل أوديرو"],
                                    "shortNameTranslation" => ["ar" => "إ. أوديرو"],
                                ],
                            ],
                            "teamId" => 2704,
                            "shirtNumber" => 77,
                            "jerseyNumber" => "77",
                            "position" => "G",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Tajon Buchanan",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "tajon-buchanan",
                                "shortName" => "T. Buchanan",
                                "position" => "D",
                                "jerseyNumber" => "17",
                                "height" => 183,
                                "userCount" => 2288,
                                "id" => 973290,
                                "country" => [
                                    "alpha2" => "CA",
                                    "alpha3" => "CAN",
                                    "name" => "Canada",
                                    "slug" => "canada",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 918432000,
                                "proposedMarketValueRaw" => [
                                    "value" => 8700000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "تاجون بوكانان"],
                                    "shortNameTranslation" => ["ar" => "ت. بوكانان"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 17,
                            "jerseyNumber" => "17",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Yann Bisseck",
                                "slug" => "yann-bisseck",
                                "shortName" => "Y. Bisseck",
                                "position" => "D",
                                "jerseyNumber" => "31",
                                "height" => 194,
                                "userCount" => 2858,
                                "id" => 906275,
                                "country" => [
                                    "alpha2" => "DE",
                                    "alpha3" => "DEU",
                                    "name" => "Germany",
                                    "slug" => "germany",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 975456000,
                                "proposedMarketValueRaw" => [
                                    "value" => 28000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "يان بيسيك"],
                                    "shortNameTranslation" => ["ar" => "ي. بيسيك"],
                                ],
                            ],
                            "teamId" => 2697,
                            "shirtNumber" => 31,
                            "jerseyNumber" => "31",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Aleksandar Stanković",
                                "slug" => "aleksandar-stankovic",
                                "shortName" => "A. Stanković",
                                "position" => "M",
                                "jerseyNumber" => "8",
                                "height" => 187,
                                "userCount" => 626,
                                "id" => 1153957,
                                "country" => [
                                    "alpha2" => "RS",
                                    "alpha3" => "SRB",
                                    "name" => "Serbia",
                                    "slug" => "serbia",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1123027200,
                                "proposedMarketValueRaw" => [
                                    "value" => 4900000,
                                    "currency" => "EUR",
                                ],
                            ],
                            "teamId" => 2453,
                            "shirtNumber" => 50,
                            "jerseyNumber" => "50",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Ebenezer Akinsanmiro",
                                "slug" => "ebenezer-akinsanmiro",
                                "shortName" => "E. Akinsanmiro",
                                "position" => "M",
                                "jerseyNumber" => "15",
                                "height" => 184,
                                "userCount" => 566,
                                "id" => 1525367,
                                "country" => [
                                    "alpha2" => "NG",
                                    "alpha3" => "NGA",
                                    "name" => "Nigeria",
                                    "slug" => "nigeria",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1101340800,
                                "proposedMarketValueRaw" => [
                                    "value" => 1900000,
                                    "currency" => "EUR",
                                ],
                            ],
                            "teamId" => 2711,
                            "shirtNumber" => 41,
                            "jerseyNumber" => "41",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Amadou Sarr",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "amadou-sarr",
                                "shortName" => "A. Sarr",
                                "position" => "F",
                                "jerseyNumber" => "23",
                                "height" => 190,
                                "userCount" => 289,
                                "id" => 1137667,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1088380800,
                                "proposedMarketValueRaw" => [
                                    "value" => 160000,
                                    "currency" => "EUR",
                                ],
                            ],
                            "teamId" => 2803,
                            "shirtNumber" => 49,
                            "jerseyNumber" => "49",
                            "position" => "F",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                    ],
                    "supportStaff" => [],
                    "formation" => "3-5-2",
                    "playerColor" => [
                        "primary" => "024ec0",
                        "number" => "ffffff",
                        "outline" => "024ec0",
                        "fancyNumber" => "ffffff",
                    ],
                    "goalkeeperColor" => [
                        "primary" => "009e17",
                        "number" => "030101",
                        "outline" => "009e17",
                        "fancyNumber" => "ffffff",
                    ],
                    "missingPlayers" => [
                        [
                            "player" => [
                                "name" => "Stefano Sensi",
                                "slug" => "stefano-sensi",
                                "shortName" => "S. Sensi",
                                "position" => "M",
                                "jerseyNumber" => "12",
                                "height" => 168,
                                "userCount" => 1273,
                                "id" => 294313,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 807580800,
                                "proposedMarketValueRaw" => [
                                    "value" => 1500000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ستيفانو سينسي"],
                                    "shortNameTranslation" => ["ar" => "س. سينسي"],
                                ],
                            ],
                            "type" => "missing",
                            "reason" => 1,
                        ],
                        [
                            "player" => [
                                "name" => "Marcus Thuram",
                                "slug" => "marcus-thuram",
                                "shortName" => "M. Thuram",
                                "position" => "F",
                                "jerseyNumber" => "9",
                                "height" => 192,
                                "userCount" => 18223,
                                "id" => 791702,
                                "country" => [
                                    "alpha2" => "FR",
                                    "alpha3" => "FRA",
                                    "name" => "France",
                                    "slug" => "france",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 870825600,
                                "proposedMarketValueRaw" => [
                                    "value" => 77000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ثورام, ماركوس"],
                                    "shortNameTranslation" => ["ar" => "م. ثورام"],
                                ],
                            ],
                            "type" => "missing",
                            "reason" => 1,
                        ],
                        [
                            "player" => [
                                "name" => "Juan Cuadrado",
                                "slug" => "juan-cuadrado",
                                "shortName" => "J. Cuadrado",
                                "position" => "M",
                                "jerseyNumber" => "7",
                                "height" => 179,
                                "userCount" => 11661,
                                "id" => 47743,
                                "country" => [
                                    "alpha2" => "CO",
                                    "alpha3" => "COL",
                                    "name" => "Colombia",
                                    "slug" => "colombia",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 580608000,
                                "proposedMarketValueRaw" => [
                                    "value" => 950000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "خوان كوادرادو"],
                                    "shortNameTranslation" => ["ar" => "خ. كوادرادو"],
                                ],
                            ],
                            "type" => "missing",
                            "reason" => 1,
                        ],
                        [
                            "player" => [
                                "name" => "Francesco Acerbi",
                                "slug" => "francesco-acerbi",
                                "shortName" => "F. Acerbi",
                                "position" => "D",
                                "jerseyNumber" => "15",
                                "height" => 192,
                                "userCount" => 3146,
                                "id" => 126816,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 571449600,
                                "proposedMarketValueRaw" => [
                                    "value" => 2900000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "فرانشيسكو آسيربي"],
                                    "shortNameTranslation" => ["ar" => "ف. آسيربي"],
                                ],
                            ],
                            "type" => "missing",
                            "reason" => 1,
                        ],
                    ],
                ],
                "away" => [
                    "players" => [
                        [
                            "player" => [
                                "name" => "Marco Carnesecchi",
                                "slug" => "marco-carnesecchi",
                                "shortName" => "M. Carnesecchi",
                                "position" => "G",
                                "jerseyNumber" => "29",
                                "height" => 192,
                                "userCount" => 1764,
                                "id" => 865646,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 962409600,
                                "proposedMarketValueRaw" => [
                                    "value" => 21000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ماركو كارنيسكي"],
                                    "shortNameTranslation" => ["ar" => "م. كارنيسكي"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 29,
                            "jerseyNumber" => "29",
                            "position" => "G",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 22,
                                "accuratePass" => 14,
                                "totalLongBalls" => 16,
                                "accurateLongBalls" => 8,
                                "aerialWon" => 1,
                                "duelWon" => 1,
                                "totalClearance" => 3,
                                "errorLeadToAGoal" => 1,
                                "goodHighClaim" => 1,
                                "savedShotsFromInsideTheBox" => 3,
                                "penaltySave" => 1,
                                "saves" => 3,
                                "totalKeeperSweeper" => 3,
                                "accurateKeeperSweeper" => 3,
                                "minutesPlayed" => 90,
                                "touches" => 32,
                                "rating" => 6.3,
                                "possessionLostCtrl" => 9,
                                "ratingVersions" => [
                                    "original" => 6.3,
                                    "alternative" => 5.7,
                                ],
                                "goalsPrevented" => -1.5418,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Giorgio Scalvini",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "giorgio-scalvini",
                                "shortName" => "G. Scalvini",
                                "position" => "D",
                                "jerseyNumber" => "42",
                                "height" => 194,
                                "userCount" => 3002,
                                "id" => 1012176,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1071100800,
                                "proposedMarketValueRaw" => [
                                    "value" => 44000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "سكالفيني ، جورجيو"],
                                    "shortNameTranslation" => ["ar" => "س. ، جورجيو"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 42,
                            "jerseyNumber" => "42",
                            "position" => "D",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 18,
                                "accuratePass" => 11,
                                "totalLongBalls" => 2,
                                "aerialLost" => 1,
                                "duelLost" => 3,
                                "duelWon" => 2,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "totalClearance" => 2,
                                "interceptionWon" => 1,
                                "totalTackle" => 1,
                                "fouls" => 2,
                                "minutesPlayed" => 58,
                                "touches" => 24,
                                "rating" => 6.1,
                                "possessionLostCtrl" => 8,
                                "ratingVersions" => [
                                    "original" => 6.1,
                                    "alternative" => 6.1,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Berat Djimsiti",
                                "slug" => "berat-djimsiti",
                                "shortName" => "B. Djimsiti",
                                "position" => "D",
                                "jerseyNumber" => "19",
                                "height" => 190,
                                "userCount" => 1862,
                                "id" => 151003,
                                "country" => [
                                    "alpha2" => "AL",
                                    "alpha3" => "ALB",
                                    "name" => "Albania",
                                    "slug" => "albania",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 730080000,
                                "proposedMarketValueRaw" => [
                                    "value" => 8700000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "بيرات دجيمسيتي"],
                                    "shortNameTranslation" => ["ar" => "ب. دجيمسيتي"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 19,
                            "jerseyNumber" => "19",
                            "position" => "D",
                            "substitute" => false,
                            "captain" => true,
                            "statistics" => [
                                "totalPass" => 54,
                                "accuratePass" => 47,
                                "totalLongBalls" => 8,
                                "accurateLongBalls" => 7,
                                "aerialLost" => 2,
                                "aerialWon" => 2,
                                "duelLost" => 2,
                                "duelWon" => 6,
                                "totalClearance" => 2,
                                "interceptionWon" => 4,
                                "totalTackle" => 2,
                                "wasFouled" => 2,
                                "minutesPlayed" => 90,
                                "touches" => 65,
                                "rating" => 6.5,
                                "possessionLostCtrl" => 7,
                                "ratingVersions" => [
                                    "original" => 6.5,
                                    "alternative" => 6.7,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Sead Kolašinac",
                                "slug" => "sead-kolasinac",
                                "shortName" => "S. Kolašinac",
                                "position" => "D",
                                "jerseyNumber" => "23",
                                "height" => 183,
                                "userCount" => 2772,
                                "id" => 142148,
                                "country" => [
                                    "alpha2" => "BA",
                                    "alpha3" => "BIH",
                                    "name" => "Bosnia & Herzegovina",
                                    "slug" => "bosnia-and-herzegovina",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 740534400,
                                "proposedMarketValueRaw" => [
                                    "value" => 10600000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "كولاسيناك, سياد"],
                                    "shortNameTranslation" => ["ar" => "س. كولاسيناك"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 23,
                            "jerseyNumber" => "23",
                            "position" => "D",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 23,
                                "accuratePass" => 22,
                                "totalLongBalls" => 1,
                                "accurateLongBalls" => 1,
                                "aerialWon" => 2,
                                "duelLost" => 1,
                                "duelWon" => 3,
                                "shotOffTarget" => 1,
                                "interceptionWon" => 1,
                                "lastManTackle" => 1,
                                "totalTackle" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 58,
                                "touches" => 28,
                                "rating" => 6.4,
                                "possessionLostCtrl" => 2,
                                "expectedGoals" => 0.0261,
                                "ratingVersions" => [
                                    "original" => 6.4,
                                    "alternative" => 6.4,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Hans Hateboer",
                                "slug" => "hans-hateboer",
                                "shortName" => "H. Hateboer",
                                "position" => "D",
                                "jerseyNumber" => "33",
                                "height" => 185,
                                "userCount" => 642,
                                "id" => 356352,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 758073600,
                                "proposedMarketValueRaw" => [
                                    "value" => 2900000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "هانس هاتيبور"],
                                    "shortNameTranslation" => ["ar" => "ه. هاتيبور"],
                                ],
                            ],
                            "teamId" => 1658,
                            "shirtNumber" => 33,
                            "jerseyNumber" => "33",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 35,
                                "accuratePass" => 30,
                                "totalLongBalls" => 2,
                                "accurateLongBalls" => 1,
                                "totalCross" => 1,
                                "accurateCross" => 1,
                                "aerialLost" => 1,
                                "aerialWon" => 3,
                                "duelLost" => 4,
                                "duelWon" => 3,
                                "challengeLost" => 1,
                                "totalContest" => 1,
                                "outfielderBlock" => 2,
                                "penaltyConceded" => 1,
                                "fouls" => 2,
                                "minutesPlayed" => 90,
                                "touches" => 50,
                                "rating" => 6.1,
                                "possessionLostCtrl" => 10,
                                "ratingVersions" => [
                                    "original" => 6.1,
                                    "alternative" => 6.1,
                                ],
                                "expectedAssists" => 0.0181947,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Mario Pašalić",
                                "slug" => "mario-pasalic",
                                "shortName" => "M. Pašalić",
                                "position" => "M",
                                "jerseyNumber" => "8",
                                "height" => 189,
                                "userCount" => 7066,
                                "id" => 190437,
                                "country" => [
                                    "alpha2" => "HR",
                                    "alpha3" => "HRV",
                                    "name" => "Croatia",
                                    "slug" => "croatia",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 792288000,
                                "proposedMarketValueRaw" => [
                                    "value" => 13400000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "بازاليتش, ماريو"],
                                    "shortNameTranslation" => ["ar" => "م. بازاليتش"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 8,
                            "jerseyNumber" => "8",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 42,
                                "accuratePass" => 37,
                                "totalLongBalls" => 5,
                                "accurateLongBalls" => 5,
                                "totalCross" => 1,
                                "duelLost" => 2,
                                "duelWon" => 4,
                                "dispossessed" => 1,
                                "totalContest" => 3,
                                "wonContest" => 2,
                                "onTargetScoringAttempt" => 1,
                                "totalClearance" => 1,
                                "totalTackle" => 2,
                                "minutesPlayed" => 90,
                                "touches" => 53,
                                "rating" => 6.9,
                                "possessionLostCtrl" => 8,
                                "expectedGoals" => 0.055,
                                "ratingVersions" => [
                                    "original" => 6.9,
                                    "alternative" => 6.8,
                                ],
                                "expectedAssists" => 0.0149728,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Éderson",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "ederson",
                                "shortName" => "Éderson",
                                "position" => "M",
                                "jerseyNumber" => "13",
                                "height" => 183,
                                "userCount" => 5405,
                                "id" => 946888,
                                "country" => [
                                    "alpha2" => "BR",
                                    "alpha3" => "BRA",
                                    "name" => "Brazil",
                                    "slug" => "brazil",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 931305600,
                                "proposedMarketValueRaw" => [
                                    "value" => 48000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "إيدرسون"],
                                    "shortNameTranslation" => ["ar" => "إيدرسون"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 13,
                            "jerseyNumber" => "13",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 51,
                                "accuratePass" => 48,
                                "totalLongBalls" => 5,
                                "accurateLongBalls" => 4,
                                "duelLost" => 2,
                                "duelWon" => 3,
                                "dispossessed" => 1,
                                "shotOffTarget" => 1,
                                "blockedScoringAttempt" => 1,
                                "totalClearance" => 2,
                                "outfielderBlock" => 2,
                                "interceptionWon" => 3,
                                "totalTackle" => 1,
                                "wasFouled" => 2,
                                "fouls" => 1,
                                "minutesPlayed" => 90,
                                "touches" => 70,
                                "rating" => 7.1,
                                "possessionLostCtrl" => 6,
                                "expectedGoals" => 0.0683,
                                "ratingVersions" => [
                                    "original" => 7.1,
                                    "alternative" => 6.9,
                                ],
                                "expectedAssists" => 0.0174529,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Davide Zappacosta",
                                "slug" => "davide-zappacosta",
                                "shortName" => "D. Zappacosta",
                                "position" => "M",
                                "jerseyNumber" => "77",
                                "height" => 182,
                                "userCount" => 1693,
                                "id" => 132318,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 708220800,
                                "proposedMarketValueRaw" => [
                                    "value" => 6500000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "زاباكوستا, دافيدي"],
                                    "shortNameTranslation" => ["ar" => "د. زاباكوستا"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 77,
                            "jerseyNumber" => "77",
                            "position" => "M",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 42,
                                "accuratePass" => 35,
                                "totalLongBalls" => 4,
                                "accurateLongBalls" => 2,
                                "totalCross" => 7,
                                "accurateCross" => 2,
                                "aerialWon" => 1,
                                "duelLost" => 5,
                                "duelWon" => 2,
                                "totalContest" => 5,
                                "wonContest" => 1,
                                "totalClearance" => 1,
                                "interceptionWon" => 1,
                                "wasFouled" => 1,
                                "fouls" => 2,
                                "minutesPlayed" => 90,
                                "touches" => 64,
                                "rating" => 6.3,
                                "possessionLostCtrl" => 18,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 6.3,
                                    "alternative" => 6.3,
                                ],
                                "expectedAssists" => 0.0466364,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Teun Koopmeiners",
                                "slug" => "teun-koopmeiners",
                                "shortName" => "T. Koopmeiners",
                                "position" => "M",
                                "jerseyNumber" => "8",
                                "height" => 183,
                                "userCount" => 7011,
                                "id" => 803033,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 888624000,
                                "proposedMarketValueRaw" => [
                                    "value" => 47000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "تيون كوبمينرز"],
                                    "shortNameTranslation" => ["ar" => "ت. كوبمينرز"],
                                ],
                            ],
                            "teamId" => 2687,
                            "shirtNumber" => 7,
                            "jerseyNumber" => "7",
                            "position" => "F",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 14,
                                "accuratePass" => 12,
                                "totalCross" => 1,
                                "aerialLost" => 1,
                                "duelLost" => 5,
                                "challengeLost" => 1,
                                "dispossessed" => 1,
                                "fouls" => 2,
                                "minutesPlayed" => 57,
                                "touches" => 19,
                                "rating" => 6.3,
                                "possessionLostCtrl" => 5,
                                "ratingVersions" => [
                                    "original" => 6.3,
                                    "alternative" => 6.3,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Aleksei Miranchuk",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "aleksei-miranchuk",
                                "shortName" => "A. Miranchuk",
                                "position" => "F",
                                "jerseyNumber" => "59",
                                "height" => 182,
                                "userCount" => 4113,
                                "id" => 324353,
                                "country" => [
                                    "alpha2" => "RU",
                                    "alpha3" => "RUS",
                                    "name" => "Russia",
                                    "slug" => "russia",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 813888000,
                                "proposedMarketValueRaw" => [
                                    "value" => 9500000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ألكساي ميرانشوك"],
                                    "shortNameTranslation" => ["ar" => "أ. ميرانشوك"],
                                ],
                            ],
                            "teamId" => 243211,
                            "shirtNumber" => 59,
                            "jerseyNumber" => "59",
                            "position" => "F",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 15,
                                "accuratePass" => 11,
                                "totalLongBalls" => 1,
                                "accurateLongBalls" => 1,
                                "totalCross" => 2,
                                "aerialWon" => 1,
                                "duelWon" => 1,
                                "shotOffTarget" => 1,
                                "totalClearance" => 1,
                                "fouls" => 1,
                                "totalOffside" => 1,
                                "minutesPlayed" => 57,
                                "touches" => 19,
                                "rating" => 6.8,
                                "possessionLostCtrl" => 6,
                                "expectedGoals" => 0.1392,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 6.8,
                                    "alternative" => 6.8,
                                ],
                                "expectedAssists" => 0.00757867,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Charles De Ketelaere",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "charles-de-ketelaere",
                                "shortName" => "C. De Ketelaere",
                                "position" => "F",
                                "jerseyNumber" => "17",
                                "height" => 192,
                                "userCount" => 13682,
                                "id" => 960441,
                                "country" => [
                                    "alpha2" => "BE",
                                    "alpha3" => "BEL",
                                    "name" => "Belgium",
                                    "slug" => "belgium",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 984182400,
                                "proposedMarketValueRaw" => [
                                    "value" => 35000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "دي كاتيلايير, تشارلز",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "ت. د. كاتيلايير",
                                    ],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 17,
                            "jerseyNumber" => "17",
                            "position" => "F",
                            "substitute" => false,
                            "statistics" => [
                                "totalPass" => 22,
                                "accuratePass" => 17,
                                "aerialLost" => 1,
                                "aerialWon" => 1,
                                "duelLost" => 1,
                                "duelWon" => 5,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "wasFouled" => 3,
                                "minutesPlayed" => 76,
                                "touches" => 30,
                                "rating" => 6.8,
                                "possessionLostCtrl" => 9,
                                "ratingVersions" => [
                                    "original" => 6.8,
                                    "alternative" => 6.7,
                                ],
                                "expectedAssists" => 0.00671709,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Michel Ndary Adopo",
                                "slug" => "michel-ndary-adopo",
                                "shortName" => "M. N. Adopo",
                                "position" => "M",
                                "jerseyNumber" => "8",
                                "height" => 187,
                                "userCount" => 268,
                                "id" => 928777,
                                "country" => [
                                    "alpha2" => "FR",
                                    "alpha3" => "FRA",
                                    "name" => "France",
                                    "slug" => "france",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 963964800,
                                "proposedMarketValueRaw" => [
                                    "value" => 1500000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "أدوبو ، ميشيل نداري",
                                    ],
                                    "shortNameTranslation" => ["ar" => "أ. ، م. نداري"],
                                ],
                            ],
                            "teamId" => 2719,
                            "shirtNumber" => 25,
                            "jerseyNumber" => "25",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 17,
                                "accuratePass" => 15,
                                "aerialLost" => 1,
                                "duelLost" => 2,
                                "duelWon" => 4,
                                "dispossessed" => 1,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "totalTackle" => 2,
                                "wasFouled" => 1,
                                "totalOffside" => 1,
                                "minutesPlayed" => 33,
                                "touches" => 25,
                                "rating" => 6.8,
                                "possessionLostCtrl" => 6,
                                "keyPass" => 1,
                                "ratingVersions" => [
                                    "original" => 6.8,
                                    "alternative" => 6.7,
                                ],
                                "expectedAssists" => 0.0572283,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Ademola Lookman",
                                "slug" => "ademola-lookman",
                                "shortName" => "A. Lookman",
                                "position" => "F",
                                "jerseyNumber" => "11",
                                "height" => 174,
                                "userCount" => 36060,
                                "id" => 824200,
                                "country" => [
                                    "alpha2" => "NG",
                                    "alpha3" => "NGA",
                                    "name" => "Nigeria",
                                    "slug" => "nigeria",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 877305600,
                                "proposedMarketValueRaw" => [
                                    "value" => 60000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "لوكمان, أديمولا"],
                                    "shortNameTranslation" => ["ar" => "أ. لوكمان"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 11,
                            "jerseyNumber" => "11",
                            "position" => "F",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 12,
                                "accuratePass" => 12,
                                "totalLongBalls" => 1,
                                "accurateLongBalls" => 1,
                                "aerialLost" => 1,
                                "duelLost" => 3,
                                "duelWon" => 2,
                                "totalContest" => 1,
                                "interceptionWon" => 1,
                                "totalTackle" => 1,
                                "wasFouled" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 33,
                                "touches" => 19,
                                "rating" => 6.6,
                                "possessionLostCtrl" => 2,
                                "ratingVersions" => [
                                    "original" => 6.6,
                                    "alternative" => 6.6,
                                ],
                                "expectedAssists" => 0.0763146,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Mitchel Bakker",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "mitchel-bakker",
                                "shortName" => "M. Bakker",
                                "position" => "D",
                                "jerseyNumber" => "20",
                                "height" => 185,
                                "userCount" => 1201,
                                "id" => 856638,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 961459200,
                                "proposedMarketValueRaw" => [
                                    "value" => 5400000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "ميتشل باكر"],
                                    "shortNameTranslation" => ["ar" => "م. باكر"],
                                ],
                            ],
                            "teamId" => 1643,
                            "shirtNumber" => 20,
                            "jerseyNumber" => "20",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 16,
                                "accuratePass" => 16,
                                "duelLost" => 3,
                                "duelWon" => 1,
                                "challengeLost" => 1,
                                "totalContest" => 2,
                                "wonContest" => 1,
                                "shotOffTarget" => 1,
                                "totalClearance" => 1,
                                "fouls" => 1,
                                "minutesPlayed" => 32,
                                "touches" => 23,
                                "rating" => 6.4,
                                "possessionLostCtrl" => 1,
                                "expectedGoals" => 0.0168,
                                "ratingVersions" => [
                                    "original" => 6.4,
                                    "alternative" => 6.3,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Isak Hien",
                                "slug" => "hien-isak",
                                "shortName" => "I. Hien",
                                "position" => "D",
                                "jerseyNumber" => "4",
                                "height" => 191,
                                "userCount" => 1662,
                                "id" => 1157713,
                                "country" => [
                                    "alpha2" => "SE",
                                    "alpha3" => "SWE",
                                    "name" => "Sweden",
                                    "slug" => "sweden",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 916185600,
                                "proposedMarketValueRaw" => [
                                    "value" => 29000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "هين ، إيزاك"],
                                    "shortNameTranslation" => ["ar" => "ه. ، إيزاك"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 4,
                            "jerseyNumber" => "4",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 18,
                                "accuratePass" => 17,
                                "totalLongBalls" => 2,
                                "accurateLongBalls" => 1,
                                "duelLost" => 1,
                                "duelWon" => 3,
                                "dispossessed" => 1,
                                "totalContest" => 1,
                                "wonContest" => 1,
                                "interceptionWon" => 1,
                                "totalTackle" => 2,
                                "minutesPlayed" => 32,
                                "touches" => 23,
                                "rating" => 6.6,
                                "possessionLostCtrl" => 2,
                                "ratingVersions" => [
                                    "original" => 6.6,
                                    "alternative" => 6.6,
                                ],
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "El Bilal Touré",
                                "slug" => "el-bilal-toure",
                                "shortName" => "E. B. Touré",
                                "position" => "F",
                                "jerseyNumber" => "10",
                                "height" => 185,
                                "userCount" => 4633,
                                "id" => 982615,
                                "country" => [
                                    "alpha2" => "ML",
                                    "alpha3" => "MLI",
                                    "name" => "Mali",
                                    "slug" => "mali",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1002067200,
                                "proposedMarketValueRaw" => [
                                    "value" => 18000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "البلال توريه"],
                                    "shortNameTranslation" => ["ar" => "ا. توريه"],
                                ],
                            ],
                            "teamId" => 2677,
                            "shirtNumber" => 10,
                            "jerseyNumber" => "10",
                            "position" => "F",
                            "substitute" => true,
                            "statistics" => [
                                "totalPass" => 8,
                                "accuratePass" => 8,
                                "totalLongBalls" => 1,
                                "accurateLongBalls" => 1,
                                "duelLost" => 2,
                                "totalClearance" => 1,
                                "fouls" => 2,
                                "minutesPlayed" => 14,
                                "touches" => 9,
                                "rating" => 6.6,
                                "ratingVersions" => [
                                    "original" => 6.6,
                                    "alternative" => 6.6,
                                ],
                                "expectedAssists" => 0.0373637,
                            ],
                        ],
                        [
                            "player" => [
                                "name" => "Juan Musso",
                                "slug" => "juan-musso",
                                "shortName" => "J. Musso",
                                "position" => "G",
                                "jerseyNumber" => "1",
                                "height" => 191,
                                "userCount" => 3803,
                                "id" => 263651,
                                "country" => [
                                    "alpha2" => "AR",
                                    "alpha3" => "ARG",
                                    "name" => "Argentina",
                                    "slug" => "argentina",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 768182400,
                                "proposedMarketValueRaw" => [
                                    "value" => 4300000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "خوان موسو"],
                                    "shortNameTranslation" => ["ar" => "خ. موسو"],
                                ],
                            ],
                            "teamId" => 2836,
                            "shirtNumber" => 1,
                            "jerseyNumber" => "1",
                            "position" => "G",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Paolo Vismara",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "vismara-paolo",
                                "shortName" => "P. Vismara",
                                "position" => "G",
                                "jerseyNumber" => "1",
                                "height" => 195,
                                "userCount" => 50,
                                "id" => 1068684,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1048809600,
                                "proposedMarketValueRaw" => [
                                    "value" => 710000,
                                    "currency" => "EUR",
                                ],
                            ],
                            "teamId" => 2711,
                            "shirtNumber" => 40,
                            "jerseyNumber" => "40",
                            "position" => "G",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Rafael Tolói",
                                "slug" => "rafael-toloi",
                                "shortName" => "R. Tolói",
                                "position" => "D",
                                "jerseyNumber" => "2",
                                "height" => 185,
                                "userCount" => 1043,
                                "id" => 82943,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 655516800,
                                "proposedMarketValueRaw" => [
                                    "value" => 1600000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "رافائيل تولوي"],
                                    "shortNameTranslation" => ["ar" => "ر. تولوي"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 2,
                            "jerseyNumber" => "2",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "José Luis Palomino",
                                "slug" => "jose-luis-palomino",
                                "shortName" => "J. L. Palomino",
                                "position" => "D",
                                "jerseyNumber" => "24",
                                "height" => 188,
                                "userCount" => 635,
                                "id" => 79680,
                                "country" => [
                                    "alpha2" => "AR",
                                    "alpha3" => "ARG",
                                    "name" => "Argentina",
                                    "slug" => "argentina",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 631497600,
                                "proposedMarketValueRaw" => [
                                    "value" => 655000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => [
                                        "ar" => "خوسيه لويس بالومينو",
                                    ],
                                    "shortNameTranslation" => [
                                        "ar" => "خ. ل. بالومينو",
                                    ],
                                ],
                            ],
                            "teamId" => 2719,
                            "shirtNumber" => 6,
                            "jerseyNumber" => "6",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Marten de Roon",
                                "slug" => "marten-de-roon",
                                "shortName" => "M. d. Roon",
                                "position" => "M",
                                "jerseyNumber" => "15",
                                "height" => 185,
                                "userCount" => 1711,
                                "id" => 100389,
                                "country" => [
                                    "alpha2" => "NL",
                                    "alpha3" => "NLD",
                                    "name" => "Netherlands",
                                    "slug" => "netherlands",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 670204800,
                                "proposedMarketValueRaw" => [
                                    "value" => 6800000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "مارتن ديرون"],
                                    "shortNameTranslation" => ["ar" => "م. ديرون"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 15,
                            "jerseyNumber" => "15",
                            "position" => "M",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Emil Holm",
                                "slug" => "emil-holm",
                                "shortName" => "E. Holm",
                                "position" => "M",
                                "jerseyNumber" => "2",
                                "height" => 191,
                                "userCount" => 850,
                                "id" => 965264,
                                "country" => [
                                    "alpha2" => "SE",
                                    "alpha3" => "SWE",
                                    "name" => "Sweden",
                                    "slug" => "sweden",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 958176000,
                                "proposedMarketValueRaw" => [
                                    "value" => 6300000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "إميل هولم"],
                                    "shortNameTranslation" => ["ar" => "إ. هولم"],
                                ],
                            ],
                            "teamId" => 2685,
                            "shirtNumber" => 3,
                            "jerseyNumber" => "3",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Matteo Ruggeri",
                                "slug" => "matteo-ruggeri",
                                "shortName" => "M. Ruggeri",
                                "position" => "M",
                                "jerseyNumber" => "22",
                                "height" => 187,
                                "userCount" => 1495,
                                "id" => 965011,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 1026345600,
                                "proposedMarketValueRaw" => [
                                    "value" => 19400000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "روجيري ، ماتيو"],
                                    "shortNameTranslation" => ["ar" => "ر. ، ماتيو"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 22,
                            "jerseyNumber" => "22",
                            "position" => "D",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                        [
                            "player" => [
                                "name" => "Gianluca Scamacca",
                                "firstName" => "",
                                "lastName" => "",
                                "slug" => "gianluca-scamacca",
                                "shortName" => "G. Scamacca",
                                "position" => "F",
                                "jerseyNumber" => "9",
                                "height" => 195,
                                "userCount" => 7149,
                                "id" => 807301,
                                "country" => [
                                    "alpha2" => "IT",
                                    "alpha3" => "ITA",
                                    "name" => "Italy",
                                    "slug" => "italy",
                                ],
                                "marketValueCurrency" => "EUR",
                                "dateOfBirthTimestamp" => 915148800,
                                "proposedMarketValueRaw" => [
                                    "value" => 33000000,
                                    "currency" => "EUR",
                                ],
                                "fieldTranslations" => [
                                    "nameTranslation" => ["ar" => "جيانلوكا سكاماكا"],
                                    "shortNameTranslation" => ["ar" => "ج. سكاماكا"],
                                ],
                            ],
                            "teamId" => 2686,
                            "shirtNumber" => 90,
                            "jerseyNumber" => "90",
                            "position" => "F",
                            "substitute" => true,
                            "statistics" => [],
                        ],
                    ],
                    "supportStaff" => [],
                    "formation" => "3-4-1-2",
                    "playerColor" => [
                        "primary" => "ffffff",
                        "number" => "000000",
                        "outline" => "ffffff",
                        "fancyNumber" => "222226",
                    ],
                    "goalkeeperColor" => [
                        "primary" => "729e65",
                        "number" => "181616",
                        "outline" => "729e65",
                        "fancyNumber" => "222226",
                    ],
                    "missingPlayers" => [],
                ],
            ],
        ];


        $jayParsedAry = ['data' =>[
            "confirmed" => true,
            "home" => [
                "players" => [
                    [
                        "player" => [
                            "name" => "Stefan Ortega",
                            "slug" => "stefan-ortega",
                            "shortName" => "S. Ortega",
                            "position" => "G",
                            "jerseyNumber" => "18",
                            "height" => 186,
                            "userCount" => 7945,
                            "id" => 125274,
                            "country" => [
                                "alpha2" => "DE",
                                "alpha3" => "DEU",
                                "name" => "Germany",
                                "slug" => "germany"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 721008000,
                            "proposedMarketValueRaw" => [
                                "value" => 8700000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ستيفان أورتيغا",
                                    "hi" => "स्टीफन ऑर्टेगा",
                                    "bn" => "স্টেফান ওর্তেগা"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "س. أورتيغا",
                                    "hi" => "एस. ऑर्टेगा",
                                    "bn" => "এস. ওর্তেগা"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 18,
                        "jerseyNumber" => "18",
                        "position" => "G",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 20,
                            "accuratePass" => 19,
                            "totalLongBalls" => 2,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "totalClearance" => 1,
                            "savedShotsFromInsideTheBox" => 1,
                            "saves" => 2,
                            "totalKeeperSweeper" => 1,
                            "accurateKeeperSweeper" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 27,
                            "rating" => 6.7,
                            "possessionLostCtrl" => 1,
                            "ratingVersions" => [
                                "original" => 6.7,
                                "alternative" => null
                            ],
                            "goalsPrevented" => -0.133
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Rico Lewis",
                            "firstName" => "Rico Lewis",
                            "lastName" => "",
                            "slug" => "rico-lewis",
                            "shortName" => "R. Lewis",
                            "position" => "D",
                            "jerseyNumber" => "82",
                            "height" => 170,
                            "userCount" => 14288,
                            "id" => 1136731,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1100995200,
                            "proposedMarketValueRaw" => [
                                "value" => 37000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ريكو لويس",
                                    "hi" => "रिको लुईस",
                                    "bn" => "রিকো লুইস"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ر. لويس",
                                    "hi" => "आर. लुईस",
                                    "bn" => "আর. লুইস"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 82,
                        "jerseyNumber" => "82",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 77,
                            "accuratePass" => 72,
                            "totalLongBalls" => 3,
                            "accurateLongBalls" => 2,
                            "goalAssist" => 0,
                            "aerialLost" => 1,
                            "aerialWon" => 1,
                            "duelLost" => 2,
                            "duelWon" => 2,
                            "dispossessed" => 1,
                            "shotOffTarget" => 1,
                            "totalClearance" => 1,
                            "outfielderBlock" => 1,
                            "totalTackle" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 88,
                            "rating" => 7.3,
                            "possessionLostCtrl" => 6,
                            "expectedGoals" => 0.0477,
                            "ratingVersions" => [
                                "original" => 7.3,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0768733
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Manuel Akanji",
                            "slug" => "manuel-akanji",
                            "shortName" => "M. Akanji",
                            "position" => "D",
                            "jerseyNumber" => "25",
                            "height" => 187,
                            "userCount" => 19395,
                            "id" => 383560,
                            "country" => [
                                "alpha2" => "CH",
                                "alpha3" => "CHE",
                                "name" => "Switzerland",
                                "slug" => "switzerland"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 806112000,
                            "proposedMarketValueRaw" => [
                                "value" => 36000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانويل أكانجي",
                                    "hi" => "मैनुअल अकांजी",
                                    "bn" => "ম্যানুয়েল আকানজি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. أكانجي",
                                    "hi" => "एम. अकांजी",
                                    "bn" => "এম. আকানজি"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 25,
                        "jerseyNumber" => "25",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 69,
                            "accuratePass" => 64,
                            "totalLongBalls" => 1,
                            "goalAssist" => 0,
                            "totalCross" => 1,
                            "aerialLost" => 3,
                            "aerialWon" => 1,
                            "duelLost" => 3,
                            "duelWon" => 2,
                            "totalClearance" => 2,
                            "outfielderBlock" => 1,
                            "errorLeadToAGoal" => 1,
                            "wasFouled" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 76,
                            "rating" => 6.3,
                            "possessionLostCtrl" => 6,
                            "keyPass" => 1,
                            "ratingVersions" => [
                                "original" => 6.3,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0194952
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Nathan Aké",
                            "slug" => "nathan-ake",
                            "shortName" => "N. Aké",
                            "position" => "D",
                            "jerseyNumber" => "6",
                            "height" => 180,
                            "userCount" => 21300,
                            "id" => 149663,
                            "country" => [
                                "alpha2" => "NL",
                                "alpha3" => "NLD",
                                "name" => "Netherlands",
                                "slug" => "netherlands"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 793065600,
                            "proposedMarketValueRaw" => [
                                "value" => 32000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ناثان آكي",
                                    "hi" => "नाथन एके",
                                    "bn" => "নাথান আকে"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ن. آكي",
                                    "hi" => "एन. एके",
                                    "bn" => "এন. আকে"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 6,
                        "jerseyNumber" => "6",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 67,
                            "accuratePass" => 61,
                            "totalLongBalls" => 6,
                            "accurateLongBalls" => 2,
                            "goalAssist" => 0,
                            "aerialLost" => 2,
                            "aerialWon" => 2,
                            "duelLost" => 2,
                            "duelWon" => 5,
                            "totalContest" => 1,
                            "wonContest" => 1,
                            "shotOffTarget" => 1,
                            "totalClearance" => 4,
                            "lastManTackle" => 1,
                            "totalTackle" => 2,
                            "minutesPlayed" => 85,
                            "touches" => 80,
                            "rating" => 7,
                            "possessionLostCtrl" => 7,
                            "expectedGoals" => 0.1129,
                            "ratingVersions" => [
                                "original" => 7,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0268131
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Joško Gvardiol",
                            "slug" => "josko-gvardiol",
                            "shortName" => "J. Gvardiol",
                            "position" => "D",
                            "jerseyNumber" => "24",
                            "height" => 186,
                            "userCount" => 52062,
                            "id" => 964994,
                            "country" => [
                                "alpha2" => "HR",
                                "alpha3" => "HRV",
                                "name" => "Croatia",
                                "slug" => "croatia"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1011744000,
                            "proposedMarketValueRaw" => [
                                "value" => 69000000,
                                "currency" => "EUR"
                            ],
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
                        "teamId" => 17,
                        "shirtNumber" => 24,
                        "jerseyNumber" => "24",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 71,
                            "accuratePass" => 66,
                            "goalAssist" => 0,
                            "totalCross" => 1,
                            "aerialLost" => 1,
                            "aerialWon" => 2,
                            "duelLost" => 4,
                            "duelWon" => 7,
                            "challengeLost" => 1,
                            "totalContest" => 4,
                            "wonContest" => 3,
                            "bigChanceMissed" => 2,
                            "shotOffTarget" => 4,
                            "blockedScoringAttempt" => 1,
                            "hitWoodwork" => 1,
                            "totalTackle" => 2,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 98,
                            "rating" => 7.1,
                            "possessionLostCtrl" => 11,
                            "expectedGoals" => 0.6665,
                            "ratingVersions" => [
                                "original" => 7.1,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0636687
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Mateo Kovačić",
                            "slug" => "mateo-kovacic",
                            "shortName" => "M. Kovačić",
                            "position" => "M",
                            "jerseyNumber" => "8",
                            "height" => 178,
                            "userCount" => 37175,
                            "id" => 136710,
                            "country" => [
                                "alpha2" => "HR",
                                "alpha3" => "HRV",
                                "name" => "Croatia",
                                "slug" => "croatia"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 768182400,
                            "proposedMarketValueRaw" => [
                                "value" => 27000000,
                                "currency" => "EUR"
                            ],
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
                        "teamId" => 17,
                        "shirtNumber" => 8,
                        "jerseyNumber" => "8",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 117,
                            "accuratePass" => 107,
                            "totalLongBalls" => 9,
                            "accurateLongBalls" => 4,
                            "goalAssist" => 0,
                            "duelLost" => 2,
                            "duelWon" => 4,
                            "challengeLost" => 2,
                            "shotOffTarget" => 1,
                            "blockedScoringAttempt" => 2,
                            "totalClearance" => 1,
                            "interceptionWon" => 1,
                            "totalTackle" => 2,
                            "wasFouled" => 2,
                            "minutesPlayed" => 85,
                            "touches" => 127,
                            "rating" => 7.3,
                            "possessionLostCtrl" => 10,
                            "expectedGoals" => 0.0713,
                            "keyPass" => 1,
                            "ratingVersions" => [
                                "original" => 7.3,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.109466
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Savinho",
                            "slug" => "savio",
                            "shortName" => "Savinho",
                            "position" => "M",
                            "jerseyNumber" => "26",
                            "height" => 176,
                            "userCount" => 41469,
                            "id" => 1046795,
                            "country" => [
                                "alpha2" => "BR",
                                "alpha3" => "BRA",
                                "name" => "Brazil",
                                "slug" => "brazil"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1081555200,
                            "proposedMarketValueRaw" => [
                                "value" => 58000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "سافيو",
                                    "hi" => "सैवियो",
                                    "bn" => "স্যাভিও"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "سافيو",
                                    "hi" => "सैवियो",
                                    "bn" => "স্যাভিও"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 26,
                        "jerseyNumber" => "26",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 36,
                            "accuratePass" => 32,
                            "goalAssist" => 0,
                            "totalCross" => 5,
                            "accurateCross" => 2,
                            "duelLost" => 7,
                            "duelWon" => 8,
                            "challengeLost" => 1,
                            "dispossessed" => 2,
                            "totalContest" => 10,
                            "wonContest" => 7,
                            "shotOffTarget" => 1,
                            "onTargetScoringAttempt" => 3,
                            "blockedScoringAttempt" => 3,
                            "wasFouled" => 1,
                            "fouls" => 1,
                            "penaltyWon" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 66,
                            "rating" => 8.2,
                            "possessionLostCtrl" => 15,
                            "expectedGoals" => 0.2187,
                            "keyPass" => 2,
                            "ratingVersions" => [
                                "original" => 8.2,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.339873
                        ]
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
                            "height" => 171,
                            "userCount" => 210466,
                            "id" => 859765,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 959472000,
                            "proposedMarketValueRaw" => [
                                "value" => 133000000,
                                "currency" => "EUR"
                            ],
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
                        "teamId" => 17,
                        "shirtNumber" => 47,
                        "jerseyNumber" => "47",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 50,
                            "accuratePass" => 45,
                            "totalLongBalls" => 6,
                            "accurateLongBalls" => 5,
                            "goalAssist" => 0,
                            "totalCross" => 8,
                            "accurateCross" => 5,
                            "aerialWon" => 1,
                            "duelLost" => 3,
                            "duelWon" => 3,
                            "dispossessed" => 2,
                            "bigChanceCreated" => 2,
                            "blockedScoringAttempt" => 2,
                            "totalTackle" => 1,
                            "wasFouled" => 1,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 69,
                            "rating" => 8.2,
                            "possessionLostCtrl" => 13,
                            "expectedGoals" => 0.1382,
                            "keyPass" => 7,
                            "ratingVersions" => [
                                "original" => 8.2,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.71326
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Bernardo Silva",
                            "slug" => "bernardo-silva",
                            "shortName" => "B. Silva",
                            "position" => "M",
                            "jerseyNumber" => "20",
                            "height" => 173,
                            "userCount" => 83473,
                            "id" => 331209,
                            "country" => [
                                "alpha2" => "PT",
                                "alpha3" => "PRT",
                                "name" => "Portugal",
                                "slug" => "portugal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 776476800,
                            "proposedMarketValueRaw" => [
                                "value" => 57000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيرناردو سيلفا",
                                    "hi" => "बर्नार्डो सिल्वा",
                                    "bn" => "বার্নার্ডো সিলভা"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ب. سيلفا",
                                    "hi" => "बी. सिल्वा",
                                    "bn" => "বি. সিলভা"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 20,
                        "jerseyNumber" => "20",
                        "position" => "M",
                        "substitute" => false,
                        "captain" => true,
                        "statistics" => [
                            "totalPass" => 68,
                            "accuratePass" => 62,
                            "totalLongBalls" => 2,
                            "accurateLongBalls" => 2,
                            "goalAssist" => 0,
                            "totalCross" => 5,
                            "accurateCross" => 1,
                            "duelLost" => 5,
                            "duelWon" => 5,
                            "challengeLost" => 1,
                            "dispossessed" => 2,
                            "totalContest" => 1,
                            "bigChanceMissed" => 1,
                            "shotOffTarget" => 1,
                            "onTargetScoringAttempt" => 1,
                            "blockedScoringAttempt" => 1,
                            "goals" => 1,
                            "totalClearance" => 1,
                            "totalTackle" => 4,
                            "wasFouled" => 1,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 90,
                            "rating" => 7.4,
                            "possessionLostCtrl" => 13,
                            "expectedGoals" => 0.2702,
                            "keyPass" => 1,
                            "ratingVersions" => [
                                "original" => 7.4,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0398748
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Jérémy Doku",
                            "slug" => "jeremy-doku",
                            "shortName" => "J. Doku",
                            "position" => "F",
                            "jerseyNumber" => "11",
                            "height" => 173,
                            "userCount" => 63499,
                            "id" => 934386,
                            "country" => [
                                "alpha2" => "BE",
                                "alpha3" => "BEL",
                                "name" => "Belgium",
                                "slug" => "belgium"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1022457600,
                            "proposedMarketValueRaw" => [
                                "value" => 56000000,
                                "currency" => "EUR"
                            ],
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
                        "teamId" => 17,
                        "shirtNumber" => 11,
                        "jerseyNumber" => "11",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 22,
                            "accuratePass" => 18,
                            "goalAssist" => 1,
                            "totalCross" => 1,
                            "accurateCross" => 1,
                            "duelLost" => 6,
                            "duelWon" => 7,
                            "challengeLost" => 1,
                            "dispossessed" => 2,
                            "totalContest" => 2,
                            "totalTackle" => 4,
                            "wasFouled" => 3,
                            "fouls" => 1,
                            "minutesPlayed" => 75,
                            "touches" => 41,
                            "rating" => 7.1,
                            "possessionLostCtrl" => 13,
                            "keyPass" => 2,
                            "ratingVersions" => [
                                "original" => 7.1,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0856761
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Erling Haaland",
                            "slug" => "erling-haaland",
                            "shortName" => "E. Haaland",
                            "position" => "F",
                            "jerseyNumber" => "9",
                            "height" => 194,
                            "userCount" => 458516,
                            "id" => 839956,
                            "country" => [
                                "alpha2" => "NO",
                                "alpha3" => "NOR",
                                "name" => "Norway",
                                "slug" => "norway"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 964137600,
                            "proposedMarketValueRaw" => [
                                "value" => 218000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إيرلينغ هالاند",
                                    "hi" => "एर्लिंग हालैंड",
                                    "bn" => "এরলিং হালান্ড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إ. هالاند",
                                    "hi" => "ई. हालैंड",
                                    "bn" => "ই. হালান্ড"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 9,
                        "jerseyNumber" => "9",
                        "position" => "F",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 13,
                            "accuratePass" => 10,
                            "goalAssist" => 0,
                            "aerialLost" => 2,
                            "aerialWon" => 2,
                            "duelLost" => 3,
                            "duelWon" => 4,
                            "totalContest" => 3,
                            "wonContest" => 2,
                            "bigChanceMissed" => 1,
                            "onTargetScoringAttempt" => 1,
                            "blockedScoringAttempt" => 1,
                            "totalClearance" => 1,
                            "totalOffside" => 2,
                            "minutesPlayed" => 90,
                            "touches" => 22,
                            "rating" => 6.5,
                            "possessionLostCtrl" => 6,
                            "expectedGoals" => 0.8168,
                            "keyPass" => 2,
                            "penaltyMiss" => 1,
                            "ratingVersions" => [
                                "original" => 6.5,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0473906
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Kevin De Bruyne",
                            "slug" => "kevin-de-bruyne",
                            "shortName" => "K. De Bruyne",
                            "position" => "M",
                            "jerseyNumber" => "17",
                            "height" => 181,
                            "userCount" => 332288,
                            "id" => 70996,
                            "country" => [
                                "alpha2" => "BE",
                                "alpha3" => "BEL",
                                "name" => "Belgium",
                                "slug" => "belgium"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 678067200,
                            "proposedMarketValueRaw" => [
                                "value" => 36000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "كيفن دي بروين",
                                    "hi" => "केविन डी ब्रूने",
                                    "bn" => "কেভিন ডি ব্রুইন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ك. دي بروين",
                                    "hi" => "के. डी ब्रूने",
                                    "bn" => "কে. ডি ব্রুইন"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 17,
                        "jerseyNumber" => "17",
                        "position" => "M",
                        "substitute" => true,
                        "statistics" => [
                            "totalPass" => 14,
                            "accuratePass" => 11,
                            "totalLongBalls" => 2,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "totalCross" => 2,
                            "accurateCross" => 1,
                            "duelWon" => 1,
                            "wasFouled" => 1,
                            "minutesPlayed" => 15,
                            "touches" => 17,
                            "rating" => 6.8,
                            "possessionLostCtrl" => 4,
                            "ratingVersions" => [
                                "original" => 6.8,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.126147
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Jahmai Simpson-Pusey",
                            "firstName" => "Jahmai Simpson-Pusey",
                            "lastName" => "",
                            "slug" => "jahmai-simpson-pusey",
                            "shortName" => "J. Simpson-Pusey",
                            "position" => "D",
                            "jerseyNumber" => "66",
                            "height" => 184,
                            "userCount" => 1531,
                            "id" => 1402924,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1131062400,
                            "proposedMarketValueRaw" => [
                                "value" => 2100000,
                                "currency" => "EUR"
                            ]
                        ],
                        "teamId" => 36544,
                        "shirtNumber" => 66,
                        "jerseyNumber" => "66",
                        "position" => "D",
                        "substitute" => true,
                        "statistics" => [
                            "totalPass" => 8,
                            "accuratePass" => 8,
                            "totalLongBalls" => 1,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "duelLost" => 1,
                            "challengeLost" => 1,
                            "minutesPlayed" => 12,
                            "touches" => 10,
                            "rating" => 6.5,
                            "ratingVersions" => [
                                "original" => 6.5,
                                "alternative" => null
                            ]
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "İlkay Gündoğan",
                            "slug" => "ilkay-gundogan",
                            "shortName" => "İ. Gündoğan",
                            "position" => "M",
                            "jerseyNumber" => "19",
                            "height" => 180,
                            "userCount" => 79508,
                            "id" => 45853,
                            "country" => [
                                "alpha2" => "DE",
                                "alpha3" => "DEU",
                                "name" => "Germany",
                                "slug" => "germany"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 656726400,
                            "proposedMarketValueRaw" => [
                                "value" => 9400000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إلكاي غوندوغان",
                                    "hi" => "इल्के गुंडोगन",
                                    "bn" => "ইল্কে গুন্ডোগান"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إ. غوندوغان",
                                    "hi" => "आई. गुंडोगन",
                                    "bn" => "আই. গুন্ডোগান"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 19,
                        "jerseyNumber" => "19",
                        "position" => "M",
                        "substitute" => true,
                        "statistics" => [
                            "totalPass" => 13,
                            "accuratePass" => 11,
                            "totalLongBalls" => 1,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "minutesPlayed" => 12,
                            "touches" => 13,
                            "rating" => 6.7,
                            "possessionLostCtrl" => 2,
                            "ratingVersions" => [
                                "original" => 6.7,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.615363
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Scott Carson",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "scott-carson",
                            "shortName" => "S. Carson",
                            "position" => "G",
                            "jerseyNumber" => "33",
                            "height" => 188,
                            "userCount" => 5320,
                            "id" => 716,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 494553600,
                            "proposedMarketValueRaw" => [
                                "value" => 210000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "سكوت كارسون",
                                    "hi" => "स्कॉट कार्सन",
                                    "bn" => "স্কট কারসন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "س. كارسون",
                                    "hi" => "एस. कार्सन",
                                    "bn" => "এস. কারসন"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 33,
                        "jerseyNumber" => "33",
                        "position" => "G",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Spike Brits",
                            "firstName" => "Spike Brits",
                            "slug" => "spike-brits",
                            "shortName" => "S. Brits",
                            "position" => "G",
                            "jerseyNumber" => "1",
                            "userCount" => 232,
                            "id" => 1546249,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1182643200
                        ],
                        "teamId" => 36544,
                        "shirtNumber" => 80,
                        "jerseyNumber" => "80",
                        "position" => "G",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Max Alleyne",
                            "slug" => "alleyne-max",
                            "shortName" => "M. Alleyne",
                            "position" => "D",
                            "jerseyNumber" => "3",
                            "height" => 185,
                            "userCount" => 983,
                            "id" => 1168513,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1121904000,
                            "proposedMarketValueRaw" => [
                                "value" => 485000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أليين، ماكس",
                                    "hi" => "एलीने, मैक्स",
                                    "bn" => "অ্যালেন, ম্যাক্স"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. أليين",
                                    "hi" => "एम. एलीने",
                                    "bn" => "এম. অ্যালেন"
                                ]
                            ]
                        ],
                        "teamId" => 36544,
                        "shirtNumber" => 68,
                        "jerseyNumber" => "68",
                        "position" => "D",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "James McAtee",
                            "slug" => "james-mcatee",
                            "shortName" => "J. McAtee",
                            "position" => "M",
                            "jerseyNumber" => "87",
                            "height" => 180,
                            "userCount" => 6517,
                            "id" => 1003334,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1034899200,
                            "proposedMarketValueRaw" => [
                                "value" => 12600000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جيمس مكاتي",
                                    "hi" => "जेम्स मैकएटी",
                                    "bn" => "জেমস ম্যাকাটি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. مكاتي",
                                    "hi" => "जे. मैकएटी",
                                    "bn" => "জে. ম্যাকাটি"
                                ]
                            ]
                        ],
                        "teamId" => 17,
                        "shirtNumber" => 87,
                        "jerseyNumber" => "87",
                        "position" => "M",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Nico O'Reilly",
                            "firstName" => "Nico",
                            "lastName" => "O’Reilly",
                            "slug" => "nico-o-reilly",
                            "shortName" => "N. O’Reilly",
                            "position" => "M",
                            "jerseyNumber" => "75",
                            "height" => 193,
                            "userCount" => 3098,
                            "id" => 1142703,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1111363200,
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "نيكو أوريلي",
                                    "hi" => "निको ओ'रेली",
                                    "bn" => "নিকো ও'রেইলি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ن. أوريلي",
                                    "hi" => "एन. ओ'रेली",
                                    "bn" => "এন. ও'রেইলি"
                                ]
                            ]
                        ],
                        "teamId" => 36544,
                        "shirtNumber" => 75,
                        "jerseyNumber" => "75",
                        "position" => "M",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Divin Mubama",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "mubama-divin",
                            "shortName" => "D. Mubama",
                            "position" => "F",
                            "jerseyNumber" => "9",
                            "height" => 183,
                            "userCount" => 1814,
                            "id" => 1167025,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1098662400,
                            "proposedMarketValueRaw" => [
                                "value" => 920000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "موباما، ديفين",
                                    "hi" => "मुबामा, दिविन",
                                    "bn" => "মুবামা, ডিভাইন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. موباما",
                                    "hi" => "डी. मुबामा",
                                    "bn" => "ডি. মুবামা"
                                ]
                            ]
                        ],
                        "teamId" => 36544,
                        "shirtNumber" => 67,
                        "jerseyNumber" => "67",
                        "position" => "F",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ]
                ],
                "supportStaff" => [
                ],
                "formation" => "4-1-4-1",
                "playerColor" => [
                    "primary" => "abd1f5",
                    "number" => "ffffff",
                    "outline" => "abd1f5",
                    "fancyNumber" => "222226"
                ],
                "goalkeeperColor" => [
                    "primary" => "30c492",
                    "number" => "f5ff3c",
                    "outline" => "30c492",
                    "fancyNumber" => "222226"
                ],
                "missingPlayers" => [
                    [
                        "player" => [
                            "name" => "Rúben Dias",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "ruben-dias",
                            "shortName" => "R. Dias",
                            "position" => "D",
                            "jerseyNumber" => "3",
                            "height" => 188,
                            "userCount" => 41118,
                            "id" => 318941,
                            "country" => [
                                "alpha2" => "PT",
                                "alpha3" => "PRT",
                                "name" => "Portugal",
                                "slug" => "portugal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 863568000,
                            "proposedMarketValueRaw" => [
                                "value" => 82000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "روبن دياز",
                                    "hi" => "रुबेन डियास",
                                    "bn" => "রুবেন ডায়াস"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ر. دياز",
                                    "hi" => "आर. डियास",
                                    "bn" => "আর. ডায়াস"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "Rodri",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "rodri",
                            "shortName" => "Rodri",
                            "position" => "M",
                            "jerseyNumber" => "16",
                            "height" => 191,
                            "userCount" => 99748,
                            "id" => 827606,
                            "country" => [
                                "alpha2" => "ES",
                                "alpha3" => "ESP",
                                "name" => "Spain",
                                "slug" => "spain"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 835401600,
                            "proposedMarketValueRaw" => [
                                "value" => 117000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "رودري",
                                    "hi" => "रोड्री",
                                    "bn" => "রডরি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "رودري",
                                    "hi" => "रोड्री",
                                    "bn" => "রডরি"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "Oscar Bobb",
                            "firstName" => "Oscar Bobb",
                            "lastName" => "",
                            "slug" => "oscar-bobb",
                            "shortName" => "O. Bobb",
                            "position" => "M",
                            "jerseyNumber" => "52",
                            "height" => 174,
                            "userCount" => 11948,
                            "id" => 1065216,
                            "country" => [
                                "alpha2" => "NO",
                                "alpha3" => "NOR",
                                "name" => "Norway",
                                "slug" => "norway"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1057968000,
                            "proposedMarketValueRaw" => [
                                "value" => 24000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أوسكار بوب",
                                    "hi" => "ऑस्कर बॉब",
                                    "bn" => "অস্কার বব"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أ. بوب",
                                    "hi" => "ओ. बॉब",
                                    "bn" => "ও. বব"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "Ederson",
                            "slug" => "ederson",
                            "shortName" => "Ederson",
                            "position" => "G",
                            "jerseyNumber" => "31",
                            "height" => 188,
                            "userCount" => 50415,
                            "id" => 254491,
                            "country" => [
                                "alpha2" => "BR",
                                "alpha3" => "BRA",
                                "name" => "Brazil",
                                "slug" => "brazil"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 745545600,
                            "proposedMarketValueRaw" => [
                                "value" => 28000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إيدرسون",
                                    "hi" => "एडरसन",
                                    "bn" => "এডারসন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إيدرسون",
                                    "hi" => "एडरसन",
                                    "bn" => "এডারসন"
                                ]
                            ]
                        ],
                        "type" => "doubtful",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "Matheus Nunes",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "matheus-nunes",
                            "shortName" => "M. Nunes",
                            "position" => "M",
                            "jerseyNumber" => "27",
                            "height" => 183,
                            "userCount" => 14464,
                            "id" => 945122,
                            "country" => [
                                "alpha2" => "PT",
                                "alpha3" => "PRT",
                                "name" => "Portugal",
                                "slug" => "portugal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 904176000,
                            "proposedMarketValueRaw" => [
                                "value" => 38000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "ماثيوس نونيز",
                                    "hi" => "मैथियस नून्स",
                                    "bn" => "ম্যাথিউস নুনেস"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. نونيز",
                                    "hi" => "एम. नून्स",
                                    "bn" => "এম. নুনেস"
                                ]
                            ]
                        ],
                        "type" => "doubtful",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "John Stones",
                            "slug" => "john-stones",
                            "shortName" => "J. Stones",
                            "position" => "D",
                            "jerseyNumber" => "5",
                            "height" => 188,
                            "userCount" => 22078,
                            "id" => 152077,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 770083200,
                            "proposedMarketValueRaw" => [
                                "value" => 29000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جون ستونز",
                                    "hi" => "जॉन स्टोन्स",
                                    "bn" => "জন স্টোনস"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. ستونز",
                                    "hi" => "जे. स्टोन्स",
                                    "bn" => "জে. স্টোনস"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ]
                ]
            ],
            "away" => [
                "players" => [
                    [
                        "player" => [
                            "name" => "Jordan Pickford",
                            "slug" => "jordan-pickford",
                            "shortName" => "J. Pickford",
                            "position" => "G",
                            "jerseyNumber" => "1",
                            "height" => 185,
                            "userCount" => 5884,
                            "id" => 138530,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 762998400,
                            "proposedMarketValueRaw" => [
                                "value" => 21000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جوردان بيكفورد",
                                    "hi" => "जॉर्डन पिकफोर्ड",
                                    "bn" => "জর্ডান পিকফোর্ড"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. بيكفورد",
                                    "hi" => "जे. पिकफोर्ड",
                                    "bn" => "জে.পিকফোর্ড"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 1,
                        "jerseyNumber" => "1",
                        "position" => "G",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 52,
                            "accuratePass" => 34,
                            "totalLongBalls" => 31,
                            "accurateLongBalls" => 13,
                            "goalAssist" => 0,
                            "duelLost" => 1,
                            "challengeLost" => 1,
                            "totalClearance" => 1,
                            "goodHighClaim" => 1,
                            "savedShotsFromInsideTheBox" => 3,
                            "penaltySave" => 1,
                            "saves" => 4,
                            "totalKeeperSweeper" => 1,
                            "accurateKeeperSweeper" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 67,
                            "rating" => 7.6,
                            "possessionLostCtrl" => 18,
                            "ratingVersions" => [
                                "original" => 7.6,
                                "alternative" => null
                            ],
                            "goalsPrevented" => 0.6643
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Séamus Coleman",
                            "slug" => "seamus-coleman",
                            "shortName" => "S. Coleman",
                            "position" => "D",
                            "jerseyNumber" => "23",
                            "height" => 177,
                            "userCount" => 729,
                            "id" => 76632,
                            "country" => [
                                "alpha2" => "IE",
                                "alpha3" => "IRL",
                                "name" => "Ireland",
                                "slug" => "ireland"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 592531200,
                            "proposedMarketValueRaw" => [
                                "value" => 540000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "شيمس كولمان",
                                    "hi" => "सीमस कोलमैन",
                                    "bn" => "সিমাস কোলম্যান"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ش. كولمان",
                                    "hi" => "एस. कोलमैन",
                                    "bn" => "এস. কোলম্যান"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 23,
                        "jerseyNumber" => "23",
                        "position" => "D",
                        "substitute" => false,
                        "captain" => true,
                        "statistics" => [
                            "totalPass" => 21,
                            "accuratePass" => 15,
                            "totalLongBalls" => 7,
                            "accurateLongBalls" => 3,
                            "goalAssist" => 0,
                            "totalCross" => 1,
                            "duelLost" => 2,
                            "duelWon" => 4,
                            "dispossessed" => 1,
                            "totalContest" => 3,
                            "wonContest" => 2,
                            "totalClearance" => 5,
                            "outfielderBlock" => 2,
                            "interceptionWon" => 1,
                            "totalTackle" => 1,
                            "wasFouled" => 1,
                            "minutesPlayed" => 89,
                            "touches" => 46,
                            "rating" => 6.9,
                            "possessionLostCtrl" => 11,
                            "ratingVersions" => [
                                "original" => 6.9,
                                "alternative" => null
                            ]
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "James Tarkowski",
                            "slug" => "james-tarkowski",
                            "shortName" => "J. Tarkowski",
                            "position" => "D",
                            "jerseyNumber" => "6",
                            "height" => 185,
                            "userCount" => 1702,
                            "id" => 145188,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 722131200,
                            "proposedMarketValueRaw" => [
                                "value" => 10300000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جيمس تاركوفسكي",
                                    "hi" => "जेम्स टार्कोव्स्की",
                                    "bn" => "জেমস তারকোভস্কি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. تاركوفسكي",
                                    "hi" => "जे. टार्कोव्स्की",
                                    "bn" => "জে. তারকোভস্কি"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 6,
                        "jerseyNumber" => "6",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 31,
                            "accuratePass" => 28,
                            "totalLongBalls" => 4,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "aerialWon" => 1,
                            "duelLost" => 1,
                            "duelWon" => 5,
                            "totalClearance" => 10,
                            "outfielderBlock" => 3,
                            "interceptionWon" => 2,
                            "totalTackle" => 3,
                            "wasFouled" => 1,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 50,
                            "rating" => 7.4,
                            "possessionLostCtrl" => 3,
                            "ratingVersions" => [
                                "original" => 7.4,
                                "alternative" => null
                            ]
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Jarrad Branthwaite",
                            "slug" => "jarrad-branthwaite",
                            "shortName" => "J. Branthwaite",
                            "position" => "D",
                            "jerseyNumber" => "32",
                            "height" => 195,
                            "userCount" => 2424,
                            "id" => 979563,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1025136000,
                            "proposedMarketValueRaw" => [
                                "value" => 43000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جاراد برانثويت",
                                    "hi" => "जेर्राड ब्रैंथवेट",
                                    "bn" => "জারাদ ব্র্যানথওয়েট"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. برانثويت",
                                    "hi" => "जे. ब्रैंथवेट",
                                    "bn" => "জে. ব্র্যানথওয়েট"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 32,
                        "jerseyNumber" => "32",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 30,
                            "accuratePass" => 24,
                            "totalLongBalls" => 4,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "aerialLost" => 2,
                            "aerialWon" => 2,
                            "duelLost" => 2,
                            "duelWon" => 4,
                            "onTargetScoringAttempt" => 1,
                            "totalClearance" => 7,
                            "outfielderBlock" => 1,
                            "totalTackle" => 2,
                            "minutesPlayed" => 90,
                            "touches" => 41,
                            "rating" => 7,
                            "possessionLostCtrl" => 6,
                            "expectedGoals" => 0.0062,
                            "ratingVersions" => [
                                "original" => 7,
                                "alternative" => null
                            ]
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Vitaliy Mykolenko",
                            "slug" => "vitaliy-mykolenko",
                            "shortName" => "V. Mykolenko",
                            "position" => "D",
                            "jerseyNumber" => "19",
                            "height" => 180,
                            "userCount" => 3880,
                            "id" => 876643,
                            "country" => [
                                "alpha2" => "UA",
                                "alpha3" => "UKR",
                                "name" => "Ukraine",
                                "slug" => "ukraine"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 927936000,
                            "proposedMarketValueRaw" => [
                                "value" => 29000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "فيتالي ميكولينكو",
                                    "hi" => "विटाली मायकोलेंको",
                                    "bn" => "ভিটালি মাইকোলেনকো"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ف. ميكولينكو",
                                    "hi" => "वी. मायकोलेंको",
                                    "bn" => "ভি. মাইকোলেনকো"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 19,
                        "jerseyNumber" => "19",
                        "position" => "D",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 27,
                            "accuratePass" => 23,
                            "totalLongBalls" => 3,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "aerialLost" => 1,
                            "duelLost" => 6,
                            "duelWon" => 2,
                            "challengeLost" => 3,
                            "totalClearance" => 4,
                            "outfielderBlock" => 2,
                            "interceptionWon" => 1,
                            "totalTackle" => 2,
                            "penaltyConceded" => 1,
                            "fouls" => 2,
                            "minutesPlayed" => 90,
                            "touches" => 42,
                            "rating" => 6.4,
                            "possessionLostCtrl" => 5,
                            "ratingVersions" => [
                                "original" => 6.4,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.00852348
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Orel Mangala",
                            "slug" => "orel-mangala",
                            "shortName" => "O. Mangala",
                            "position" => "M",
                            "jerseyNumber" => "8",
                            "height" => 178,
                            "userCount" => 1850,
                            "id" => 793988,
                            "country" => [
                                "alpha2" => "BE",
                                "alpha3" => "BEL",
                                "name" => "Belgium",
                                "slug" => "belgium"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 890179200,
                            "proposedMarketValueRaw" => [
                                "value" => 19100000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مانغالا، أوريل",
                                    "hi" => "मंगला, ओरेल",
                                    "bn" => "মঙ্গলা, ওরেল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أ. مانغالا",
                                    "hi" => "ओ. मंगला",
                                    "bn" => "ও. মঙ্গলা"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 8,
                        "jerseyNumber" => "8",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 37,
                            "accuratePass" => 34,
                            "totalLongBalls" => 2,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "duelLost" => 4,
                            "duelWon" => 2,
                            "challengeLost" => 1,
                            "dispossessed" => 2,
                            "totalContest" => 2,
                            "wonContest" => 2,
                            "shotOffTarget" => 2,
                            "totalClearance" => 1,
                            "outfielderBlock" => 1,
                            "interceptionWon" => 2,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 50,
                            "rating" => 6.8,
                            "possessionLostCtrl" => 6,
                            "expectedGoals" => 0.0691,
                            "ratingVersions" => [
                                "original" => 6.8,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0115499
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Idrissa Gueye",
                            "slug" => "idrissa-gueye",
                            "shortName" => "I. Gueye",
                            "position" => "M",
                            "jerseyNumber" => "27",
                            "height" => 174,
                            "userCount" => 11252,
                            "id" => 106337,
                            "country" => [
                                "alpha2" => "SN",
                                "alpha3" => "SEN",
                                "name" => "Senegal",
                                "slug" => "senegal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 622771200,
                            "proposedMarketValueRaw" => [
                                "value" => 1900000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إدريسا غاي",
                                    "hi" => "इद्रिसा गुये",
                                    "bn" => "ইদ্রিসা গুইয়ে"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إ. غاي",
                                    "hi" => "आई. गुये",
                                    "bn" => "আই. গুইয়ে"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 27,
                        "jerseyNumber" => "27",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 35,
                            "accuratePass" => 31,
                            "totalLongBalls" => 3,
                            "accurateLongBalls" => 3,
                            "goalAssist" => 0,
                            "duelLost" => 2,
                            "duelWon" => 4,
                            "totalContest" => 1,
                            "onTargetScoringAttempt" => 1,
                            "totalClearance" => 2,
                            "outfielderBlock" => 1,
                            "totalTackle" => 4,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 52,
                            "rating" => 7.1,
                            "possessionLostCtrl" => 7,
                            "expectedGoals" => 0.0178,
                            "ratingVersions" => [
                                "original" => 7.1,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.00544134
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Abdoulaye Doucouré",
                            "slug" => "abdoulaye-doucoure",
                            "shortName" => "A. Doucouré",
                            "position" => "F",
                            "jerseyNumber" => "16",
                            "height" => 182,
                            "userCount" => 1488,
                            "id" => 96535,
                            "country" => [
                                "alpha2" => "ML",
                                "alpha3" => "MLI",
                                "name" => "Mali",
                                "slug" => "mali"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 725846400,
                            "proposedMarketValueRaw" => [
                                "value" => 7700000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "عبدالله دوكوري",
                                    "hi" => "अब्दुलाये डौकोरे",
                                    "bn" => "আবদুলায়ে ডকোরে"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ع. دوكوري",
                                    "hi" => "ए. डौकोरे",
                                    "bn" => "এ. ডকোরে"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 16,
                        "jerseyNumber" => "16",
                        "position" => "M",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 25,
                            "accuratePass" => 24,
                            "totalLongBalls" => 1,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "totalCross" => 1,
                            "duelLost" => 4,
                            "duelWon" => 3,
                            "challengeLost" => 2,
                            "totalContest" => 1,
                            "wonContest" => 1,
                            "blockedScoringAttempt" => 1,
                            "totalTackle" => 2,
                            "fouls" => 2,
                            "totalOffside" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 35,
                            "rating" => 6.7,
                            "possessionLostCtrl" => 6,
                            "expectedGoals" => 0.0439,
                            "ratingVersions" => [
                                "original" => 6.7,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0101148
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Jack Harrison",
                            "slug" => "jack-harrison",
                            "shortName" => "J. Harrison",
                            "position" => "M",
                            "jerseyNumber" => "11",
                            "height" => 175,
                            "userCount" => 1225,
                            "id" => 829570,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 848448000,
                            "proposedMarketValueRaw" => [
                                "value" => 17300000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جاك هاريسون",
                                    "hi" => "जैक हैरिसन",
                                    "bn" => "জ্যাক হ্যারিসন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. هاريسون",
                                    "hi" => "जे. हैरिसन",
                                    "bn" => "জে. হ্যারিসন"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 11,
                        "jerseyNumber" => "11",
                        "position" => "F",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 12,
                            "accuratePass" => 9,
                            "totalLongBalls" => 1,
                            "accurateLongBalls" => 1,
                            "goalAssist" => 0,
                            "totalCross" => 9,
                            "accurateCross" => 4,
                            "aerialLost" => 2,
                            "duelLost" => 10,
                            "duelWon" => 2,
                            "challengeLost" => 2,
                            "dispossessed" => 2,
                            "totalContest" => 4,
                            "wonContest" => 1,
                            "blockedScoringAttempt" => 1,
                            "totalClearance" => 2,
                            "wasFouled" => 1,
                            "fouls" => 1,
                            "minutesPlayed" => 90,
                            "touches" => 33,
                            "rating" => 6.7,
                            "possessionLostCtrl" => 14,
                            "expectedGoals" => 0.0796,
                            "keyPass" => 3,
                            "ratingVersions" => [
                                "original" => 6.7,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.201091
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Dominic Calvert-Lewin",
                            "slug" => "dominic-calvert-lewin",
                            "shortName" => "D. Calvert-Lewin",
                            "position" => "F",
                            "jerseyNumber" => "9",
                            "height" => 187,
                            "userCount" => 4530,
                            "id" => 372344,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 858470400,
                            "proposedMarketValueRaw" => [
                                "value" => 24000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "دومينيك كالفيرت-لوين",
                                    "hi" => "डोमिनिक कैल्वर्ट-लेविन",
                                    "bn" => "ডমিনিক কালভার্ট-লেউইন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "د. كالفيرت-لوين",
                                    "hi" => "डी. कैल्वर्ट-लेविन",
                                    "bn" => "ডি. কালভার্ট-লেউইন"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 9,
                        "jerseyNumber" => "9",
                        "position" => "F",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 12,
                            "accuratePass" => 5,
                            "goalAssist" => 0,
                            "aerialLost" => 3,
                            "aerialWon" => 5,
                            "duelLost" => 8,
                            "duelWon" => 7,
                            "challengeLost" => 1,
                            "dispossessed" => 2,
                            "shotOffTarget" => 1,
                            "totalTackle" => 1,
                            "wasFouled" => 1,
                            "fouls" => 2,
                            "totalOffside" => 1,
                            "minutesPlayed" => 70,
                            "touches" => 25,
                            "rating" => 6.6,
                            "possessionLostCtrl" => 13,
                            "expectedGoals" => 0.1875,
                            "ratingVersions" => [
                                "original" => 6.6,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.00503458
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Iliman Ndiaye",
                            "slug" => "iliman-ndiaye",
                            "shortName" => "I. Ndiaye",
                            "position" => "F",
                            "jerseyNumber" => "10",
                            "height" => 180,
                            "userCount" => 15412,
                            "id" => 914309,
                            "country" => [
                                "alpha2" => "SN",
                                "alpha3" => "SEN",
                                "name" => "Senegal",
                                "slug" => "senegal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 952300800,
                            "proposedMarketValueRaw" => [
                                "value" => 17500000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "إليمان نداي",
                                    "hi" => "इलीमन नदिये",
                                    "bn" => "ইলিমান এনদিয়ায়ে"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "إ. نداي",
                                    "hi" => "आई. नदिये",
                                    "bn" => "আই. এনদিয়ায়ে"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 10,
                        "jerseyNumber" => "10",
                        "position" => "F",
                        "substitute" => false,
                        "statistics" => [
                            "totalPass" => 23,
                            "accuratePass" => 21,
                            "totalLongBalls" => 2,
                            "accurateLongBalls" => 2,
                            "goalAssist" => 0,
                            "totalCross" => 4,
                            "accurateCross" => 1,
                            "aerialLost" => 1,
                            "duelLost" => 6,
                            "duelWon" => 2,
                            "challengeLost" => 2,
                            "totalContest" => 3,
                            "onTargetScoringAttempt" => 1,
                            "goals" => 1,
                            "totalClearance" => 2,
                            "totalTackle" => 2,
                            "minutesPlayed" => 81,
                            "touches" => 38,
                            "rating" => 7.2,
                            "possessionLostCtrl" => 9,
                            "expectedGoals" => 0.2429,
                            "keyPass" => 1,
                            "ratingVersions" => [
                                "original" => 7.2,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0121382
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Armando Broja",
                            "firstName" => "",
                            "lastName" => "",
                            "slug" => "armando-broja",
                            "shortName" => "A. Broja",
                            "position" => "F",
                            "jerseyNumber" => "22",
                            "height" => 191,
                            "userCount" => 8842,
                            "id" => 996985,
                            "country" => [
                                "alpha2" => "AL",
                                "alpha3" => "ALB",
                                "name" => "Albania",
                                "slug" => "albania"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1000080000,
                            "proposedMarketValueRaw" => [
                                "value" => 13600000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "أرماندو برويا",
                                    "hi" => "अरमांडो ब्रोजा",
                                    "bn" => "আরমান্দো ব্রজা"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "أ. برويا",
                                    "hi" => "ए. ब्रोजा",
                                    "bn" => "এ. ব্রজা"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 22,
                        "jerseyNumber" => "22",
                        "position" => "F",
                        "substitute" => true,
                        "statistics" => [
                            "totalPass" => 7,
                            "accuratePass" => 7,
                            "goalAssist" => 0,
                            "aerialWon" => 1,
                            "duelLost" => 1,
                            "duelWon" => 3,
                            "totalContest" => 2,
                            "wonContest" => 1,
                            "wasFouled" => 1,
                            "minutesPlayed" => 20,
                            "touches" => 12,
                            "rating" => 6.8,
                            "possessionLostCtrl" => 2,
                            "keyPass" => 2,
                            "ratingVersions" => [
                                "original" => 6.8,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.00987208
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Jesper Lindstrøm",
                            "slug" => "jesper-lindstrom",
                            "shortName" => "J. Lindstrøm",
                            "position" => "M",
                            "jerseyNumber" => "29",
                            "height" => 182,
                            "userCount" => 3033,
                            "id" => 947929,
                            "country" => [
                                "alpha2" => "DK",
                                "alpha3" => "DNK",
                                "name" => "Denmark",
                                "slug" => "denmark"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 951782400,
                            "proposedMarketValueRaw" => [
                                "value" => 22000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جيسبر ليندستروم",
                                    "hi" => "जेस्पर लिंडस्ट्रोम",
                                    "bn" => "জেসপার লিন্ডস্ট্রোম"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. ليندستروم",
                                    "hi" => "जे. लिंडस्ट्रोम",
                                    "bn" => "জে. লিন্ডস্ট্রোম"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 29,
                        "jerseyNumber" => "29",
                        "position" => "M",
                        "substitute" => true,
                        "statistics" => [
                            "totalPass" => 4,
                            "accuratePass" => 3,
                            "goalAssist" => 0,
                            "totalCross" => 1,
                            "accurateCross" => 1,
                            "duelLost" => 1,
                            "challengeLost" => 1,
                            "interceptionWon" => 1,
                            "minutesPlayed" => 9,
                            "touches" => 9,
                            "rating" => 6.6,
                            "possessionLostCtrl" => 2,
                            "ratingVersions" => [
                                "original" => 6.6,
                                "alternative" => null
                            ],
                            "expectedAssists" => 0.0273661
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Nathan Patterson",
                            "slug" => "patterson-nathan",
                            "shortName" => "N. Patterson",
                            "position" => "D",
                            "jerseyNumber" => "2",
                            "height" => 189,
                            "userCount" => 659,
                            "id" => 1020141,
                            "country" => [
                                "alpha2" => "SX",
                                "alpha3" => "SCO",
                                "name" => "Scotland",
                                "slug" => "scotland"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1003190400,
                            "proposedMarketValueRaw" => [
                                "value" => 16300000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "باترسون، ناثان",
                                    "hi" => "पैटरसन, नाथन",
                                    "bn" => "প্যাটারসন, নাথান"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ن. باترسون",
                                    "hi" => "एन. पैटरसन",
                                    "bn" => "এন. প্যাটারসন"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 2,
                        "jerseyNumber" => "2",
                        "position" => "D",
                        "substitute" => true,
                        "statistics" => [
                            "totalPass" => 2,
                            "accuratePass" => 1,
                            "goalAssist" => 0,
                            "totalClearance" => 1,
                            "minutesPlayed" => 1,
                            "touches" => 4,
                            "possessionLostCtrl" => 1
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "João Virgínia",
                            "slug" => "joao-virginia",
                            "shortName" => "J. Virgínia",
                            "position" => "G",
                            "jerseyNumber" => "12",
                            "height" => 191,
                            "userCount" => 527,
                            "id" => 930666,
                            "country" => [
                                "alpha2" => "PT",
                                "alpha3" => "PRT",
                                "name" => "Portugal",
                                "slug" => "portugal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 939513600,
                            "proposedMarketValueRaw" => [
                                "value" => 730000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جواو فيرجينيا",
                                    "hi" => "जोआओ विरजीनिया",
                                    "bn" => "জন ভার্জিনিয়া"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. فيرجينيا",
                                    "hi" => "जे. विरजीनिया",
                                    "bn" => "জে. ভার্জিনিয়া"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 12,
                        "jerseyNumber" => "12",
                        "position" => "G",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Michael Keane",
                            "slug" => "michael-keane",
                            "shortName" => "M. Keane",
                            "position" => "D",
                            "jerseyNumber" => "5",
                            "height" => 188,
                            "userCount" => 742,
                            "id" => 110846,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 726710400,
                            "proposedMarketValueRaw" => [
                                "value" => 5600000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "مايكل كين",
                                    "hi" => "माइकल कीन",
                                    "bn" => "মাইকেল কিন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "م. كين",
                                    "hi" => "एम. कीन",
                                    "bn" => "এম. কিন"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 5,
                        "jerseyNumber" => "5",
                        "position" => "D",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Jake O'Brien",
                            "slug" => "jake-obrien",
                            "shortName" => "J. O'Brien",
                            "position" => "D",
                            "jerseyNumber" => "15",
                            "height" => 197,
                            "userCount" => 935,
                            "id" => 998253,
                            "country" => [
                                "alpha2" => "IE",
                                "alpha3" => "IRL",
                                "name" => "Ireland",
                                "slug" => "ireland"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 989884800,
                            "proposedMarketValueRaw" => [
                                "value" => 13700000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جايك أوبراين",
                                    "hi" => "जेक ओ'ब्रायन",
                                    "bn" => "জ্যাক ও'ব্রায়েন"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. أوبراين",
                                    "hi" => "जे. ओ'ब्रायन",
                                    "bn" => "জে. ও'ব্রায়েন"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 15,
                        "jerseyNumber" => "15",
                        "position" => "D",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Harrison Armstrong",
                            "slug" => "harrison-armstrong",
                            "shortName" => "H. Armstrong",
                            "position" => "M",
                            "jerseyNumber" => "45",
                            "height" => 185,
                            "userCount" => 140,
                            "id" => 1627560,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1169164800,
                            "proposedMarketValueRaw" => [
                                "value" => 515000,
                                "currency" => "EUR"
                            ]
                        ],
                        "teamId" => 36553,
                        "shirtNumber" => 45,
                        "jerseyNumber" => "45",
                        "position" => "M",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Beto",
                            "slug" => "beto",
                            "shortName" => "Beto",
                            "position" => "F",
                            "jerseyNumber" => "14",
                            "height" => 194,
                            "userCount" => 1978,
                            "id" => 987489,
                            "country" => [
                                "alpha2" => "GW",
                                "alpha3" => "GNB",
                                "name" => "Guinea-Bissau",
                                "slug" => "guinea-bissau"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 886204800,
                            "proposedMarketValueRaw" => [
                                "value" => 21000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "بيتو",
                                    "hi" => "बेटो",
                                    "bn" => "বেটো"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "بيتو",
                                    "hi" => "बेटो",
                                    "bn" => "বেটো"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 14,
                        "jerseyNumber" => "14",
                        "position" => "F",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ],
                    [
                        "player" => [
                            "name" => "Youssef Chermiti",
                            "slug" => "youssef-chermiti",
                            "shortName" => "Y. Chermiti",
                            "position" => "F",
                            "jerseyNumber" => "17",
                            "height" => 192,
                            "userCount" => 1593,
                            "id" => 1145627,
                            "country" => [
                                "alpha2" => "PT",
                                "alpha3" => "PRT",
                                "name" => "Portugal",
                                "slug" => "portugal"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1085356800,
                            "proposedMarketValueRaw" => [
                                "value" => 9300000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "يوسف شرميطي",
                                    "hi" => "यूसुफ़ चेरमीटी",
                                    "bn" => "ইউসুফ চেরমিতি"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ي. شرميطي",
                                    "hi" => "वाई. चेरमीटी",
                                    "bn" => "ওয়াই. চেরমিতি"
                                ]
                            ]
                        ],
                        "teamId" => 48,
                        "shirtNumber" => 17,
                        "jerseyNumber" => "17",
                        "position" => "F",
                        "substitute" => true,
                        "statistics" => [
                        ]
                    ]
                ],
                "supportStaff" => [
                ],
                "formation" => "4-3-3",
                "playerColor" => [
                    "primary" => "262626",
                    "number" => "e8d100",
                    "outline" => "262626",
                    "fancyNumber" => "ffffff"
                ],
                "goalkeeperColor" => [
                    "primary" => "32e953",
                    "number" => "ffffff",
                    "outline" => "32e953",
                    "fancyNumber" => "222226"
                ],
                "missingPlayers" => [
                    [
                        "player" => [
                            "name" => "Ashley Young",
                            "slug" => "ashley-young",
                            "shortName" => "A. Young",
                            "position" => "D",
                            "jerseyNumber" => "18",
                            "height" => 180,
                            "userCount" => 2017,
                            "id" => 10589,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 489715200,
                            "proposedMarketValueRaw" => [
                                "value" => 550000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "آشلي يونغ",
                                    "hi" => "एश्ले यंग",
                                    "bn" => "অ্যাশলে ইয়াং"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "آ. يونغ",
                                    "hi" => "एक यंग",
                                    "bn" => "এ. ইয়াং"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 11
                    ],
                    [
                        "player" => [
                            "name" => "Tim Iroegbunam",
                            "slug" => "tim-iroegbunam",
                            "shortName" => "T. Iroegbunam",
                            "position" => "M",
                            "jerseyNumber" => "47",
                            "height" => 182,
                            "userCount" => 638,
                            "id" => 1085950,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 1056931200,
                            "proposedMarketValueRaw" => [
                                "value" => 10300000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "تيم إيروغبونام",
                                    "hi" => "टिम इरोएगबुनम",
                                    "bn" => "টিম ইরোগবুনাম"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ت. إيروغبونام",
                                    "hi" => "टी. इरोएगबुनम",
                                    "bn" => "টি. ইরোগবুনাম"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "James Garner",
                            "slug" => "james-garner",
                            "shortName" => "J. Garner",
                            "position" => "M",
                            "jerseyNumber" => "37",
                            "height" => 182,
                            "userCount" => 2091,
                            "id" => 927361,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 984441600,
                            "proposedMarketValueRaw" => [
                                "value" => 21000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "جيمس غارنر",
                                    "hi" => "जेम्स गार्नर",
                                    "bn" => "জেমস গার্নার"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "ج. غارنر",
                                    "hi" => "जे. गार्नर",
                                    "bn" => "জে. গার্নার"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ],
                    [
                        "player" => [
                            "name" => "Dwight McNeil",
                            "slug" => "dwight-mcneil",
                            "shortName" => "D. McNeil",
                            "position" => "M",
                            "jerseyNumber" => "7",
                            "height" => 183,
                            "userCount" => 2330,
                            "id" => 935543,
                            "country" => [
                                "alpha2" => "EN",
                                "alpha3" => "ENG",
                                "name" => "England",
                                "slug" => "england"
                            ],
                            "marketValueCurrency" => "EUR",
                            "dateOfBirthTimestamp" => 943228800,
                            "proposedMarketValueRaw" => [
                                "value" => 26000000,
                                "currency" => "EUR"
                            ],
                            "fieldTranslations" => [
                                "nameTranslation" => [
                                    "ar" => "دوايت مكنيل",
                                    "hi" => "ड्वाइट मैकनील",
                                    "bn" => "ডোয়াইট ম্যাকনিল"
                                ],
                                "shortNameTranslation" => [
                                    "ar" => "د. مكنيل",
                                    "hi" => "डी. मैकनील",
                                    "bn" => "ডি. ম্যাকনিল"
                                ]
                            ]
                        ],
                        "type" => "missing",
                        "reason" => 1
                    ]
                ]
            ]]
        ];


        return $jayParsedAry;
    }
}
