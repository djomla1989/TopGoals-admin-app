<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\AllSports\TournamentAllSports;
use App\Models\AllSports\TournamentSeasonAllSports;
use App\Models\DataMapping;
use App\Models\Tipster\TournamentSeasonsTipster;
use Illuminate\Http\Request;

class MapTournamentSeasonsController extends Controller
{
    public function index()
    {
        $allMappedTournaments = DataMapping::where('table_name', 'tournaments')->get()->keyBy('source_id');

        $tournamentList = [];

        foreach ($allMappedTournaments as $mappedTournament) {
            $tournament = TournamentAllSports::find($mappedTournament->source_id);
            $hasSeasons = TournamentSeasonsTipster::where('tournament_id', $mappedTournament->tipster_table_id)->exists();
            if ($hasSeasons === false) {
                continue;
            }
            $tournamentList[$mappedTournament->id] = $tournament;
        }

        return view('mapping.tournament.season.index', compact('tournamentList'));
    }

    public function mapSeason(DataMapping $dataMapping, bool $debug = false)
    {
        if ($dataMapping->table_name !== 'tournaments') {
            abort(404, 'Mapping not found.');
        }

        $sourceSeasons = TournamentSeasonAllSports::where('tournament_id', $dataMapping->source_id)->get();

        $mapSeason = TournamentSeasonsTipster::where('tournament_id', $dataMapping->tipster_table_id)->orderBy('name')->get();

        $mappings = DataMapping::where('table_name', 'seasons')->get()->keyBy('source_id');

        $tournament = TournamentAllSports::find($dataMapping->source_id);

        if ($debug) {
            $listA = $sourceSeasons->map(function ($season) {
                return $season->name;
            })->toArray();
            $listB = $mapSeason->map(function ($season) {
                return $season->name;
            })->toArray();

            function suggestTournamentMapping($listA, $listB)
            {
                $suggestions = [];
                foreach ($listB as $aTournament) {
                    foreach ($listA as $bTournament) {
                        $similarity = levenshtein(
                            strtolower($aTournament),
                            strtolower($bTournament)
                        );
                        if ($similarity < 10) { // Prag sličnosti
                            $suggestions[] = [
                                'source_a_tournament' => $aTournament,
                                'source_b_tournament' => $bTournament,
                                'similarity_score' => $similarity,
                            ];
                        }
                    }
                }

                return $suggestions;
            }

            // Primer poziva
            $suggestions = suggestTournamentMapping($listA, $listB);

            // Sortirajte predloge prema oceni sličnosti
            usort($suggestions, fn ($a, $b) => $a['similarity_score'] <=> $b['similarity_score']);
            dd($suggestions);
        }

        return view('mapping.tournament.season.mapSeason', compact(
            'sourceSeasons',
            'mapSeason',
            'dataMapping',
            'mappings',
            'tournament'
        )
        );

    }

    public function store(Request $request, DataMapping $dataMapping)
    {
        $mappingsInput = $request->input('mapping', []);

        foreach ($mappingsInput as $sourceAId => $sourceBId) {
            if (! empty($sourceBId)) {
                DataMapping::updateOrCreate(
                    ['source_id' => $sourceAId, 'table_name' => 'seasons'], ['tipster_table_id' => $sourceBId]
                );
            }
        }

        return redirect()->back()->with('success', 'Mapiranja su sačuvana.');
    }
}
