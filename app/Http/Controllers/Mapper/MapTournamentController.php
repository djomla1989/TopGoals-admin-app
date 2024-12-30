<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DataMapping;
use App\Models\Tipster\TournamentTipster;
use App\Models\Tournament;
use App\Services\DataImporters\Mappers\TournamentMapper;
use Illuminate\Http\Request;

class MapTournamentController extends Controller
{
    public function index()
    {
        $allMappedCategories = DataMapping::where('table_name', 'categories')->get()->keyBy('source_id');

        $categoryList = [];

        foreach ($allMappedCategories as $mappedCategory) {
            $category = Category::find($mappedCategory->source_id);
            $categoryList[$mappedCategory->id] = $category;
        }

        return view('mapping.tournament.index', compact('categoryList'));
    }

    public function mapTournament(DataMapping $dataMapping, bool $debug = false)
    {
        if ($dataMapping->table_name !== 'categories') {
            abort(404, 'Mapping not found.');
        }

        $sourceTournaments = Tournament::where('category_id', $dataMapping->source_id)->get();

        $mapTournament = TournamentTipster::where('category_id', $dataMapping->tipster_table_id)->orderBy('name')->get();

        $mappings = DataMapping::where('table_name', 'tournaments')->get()->keyBy('source_id');

        $category = Category::find($dataMapping->source_id);

        $tournamentMapper = new TournamentMapper();
        $autoMapper = $tournamentMapper->mapByNames($category, $mapTournament->toArray());

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

        $autoMapper = array_column($autoMapper, 'id','init_id');

        return view('mapping.tournament.mapTournament', compact(
            'sourceTournaments',
            'mapTournament',
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

    public function store(Request $request, DataMapping $dataMapping)
    {
        $mappingsInput = $request->input('mapping', []);

        foreach ($mappingsInput as $sourceAId => $sourceBId) {
            if (! empty($sourceBId)) {
                DataMapping::updateOrCreate(
                    ['source_id' => $sourceAId, 'table_name' => 'tournaments'], ['tipster_table_id' => $sourceBId]
                );
            }
        }

        return redirect()->back()->with('success', 'Mapiranja su sačuvana.');
    }
}
