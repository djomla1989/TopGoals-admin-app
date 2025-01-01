<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DataMapping;
use App\Models\OsSport\CategoryOsSport;
use App\Models\OsSport\TournamentOsSport;
use App\Models\SportRadar\TournamentSportRadar;
use App\Models\Tipster\TournamentTipster;
use App\Models\Tournament;
use App\Services\DataImporters\Mappers\TournamentMapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MapTournamentController extends Controller
{
    public function index()
    {
        $allMappedCategories = DataMapping::where('table_name', 'categories')->get()->keyBy('ossport_table_id');

        $categoryList = [];

        foreach ($allMappedCategories as $mappedCategory) {
            $category = CategoryOsSport::find($mappedCategory->ossport_table_id);
            $categoryList[$mappedCategory->id] = $category;
        }

        return view('mapping.tournament.index', compact('categoryList'));
    }

    public function mapTournament(DataMapping $dataMapping, bool $debug = false)
    {
        if ($dataMapping->table_name !== 'categories') {
            abort(404, 'Mapping not found.');
        }

        $osSportTournaments = TournamentOsSport::where('category_id', $dataMapping->ossport_table_id)->get();

        $allSportsTournaments = Tournament::where('category_id', $dataMapping->allsport_table_id)->orderBy('name')->get();

        $oddsFeedTournaments = TournamentTipster::where('category_id', $dataMapping->oddsfeed_table_id)->orderBy('name')->get();

        $sportRadarTournaments = TournamentSportRadar::where('category_id', $dataMapping->sportradar_table_id)->orderBy('name')->get();

        $mappings = DataMapping::where('table_name', 'tournaments')->get()->keyBy('ossport_table_id');

        $category = Category::find($dataMapping->ossport_table_id);

//        $tournamentMapper = new TournamentMapper();
//        $autoMapper = $tournamentMapper->mapByNames($category, $mapTournament->toArray());

        if ($debug) {
            $listA = $sourceTournaments->map(function ($tournament) {
                return $tournament->name;
            })->toArray();
            $listB = $mapTournament->map(function ($tournament) {
                return $tournament->name;
            })->toArray();

            // Primer poziva
            $suggestions = $this->suggestTournamentMapping($listA, $listB);

            // Sortirajte predloge prema oceni sličnosti
            usort($suggestions, fn ($a, $b) => $a['similarity_score'] <=> $b['similarity_score']);
            dd($suggestions);
        }

        //$autoMapper = array_column($autoMapper, 'id','init_id');
        $autoMapper = [];

        return view('mapping.tournament.mapTournament', compact(
            'osSportTournaments',
            'allSportsTournaments',
            'oddsFeedTournaments',
            'sportRadarTournaments',
            'dataMapping',
            'mappings',
            'autoMapper',
            'category'
        )
        );

    }

    public function suggestTournamentMapping($listA, $listB)
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

    public function store(Request $request)
    {
        $mappingsInput = $request->input('mapping', []);

        foreach ($mappingsInput['allsport'] as $ossportId => $allsportId) {

            $oddsfeedId = $mappingsInput['oddsfeed'][$ossportId] ?? null;
            $sportRadarId = $mappingsInput['sportradar'][$ossportId] ?? null;

            DataMapping::updateOrCreate(
                [
                    'ossport_table_id' => $ossportId,
                    'table_name' => 'tournaments'
                ],
                [
                    'allsport_table_id' => $allsportId,
                    'oddsfeed_table_id' => $oddsfeedId,
                    'sportradar_table_id' => $sportRadarId
                ]
            );
        }

        Session::flash('message', 'Tournament mapping saved.');

        return redirect()->back()->with('success', 'Mapiranja su sačuvana.');
    }
}
