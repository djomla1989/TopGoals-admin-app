<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\Category;
use App\Models\DataMapping;
use App\Models\OsSport\CategoryOsSport;
use App\Models\SportRadar\CategorySportRadar;
use App\Models\Tipster\CategoryTipster;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MappingCategory extends Controller
{
    public function index(): View
    {
        $table = 'categories';

        $dataOsSports = CategoryOsSport::all();
        $dataAllSports = Category::all();
        $dataOddsFeed = CategoryTipster::all();
        $dataSportRadar = CategorySportRadar::orderBy('name')->get();



//        $sport = Sport::first();
//        $categoryMapper = new CategoryMapper();
//        $mapping = $categoryMapper->mapByNames($sport, $dataA->toArray());
        $mappings = DataMapping::where('table_name', $table)->get()->keyBy('ossport_table_id');
        return view('mapping.category', compact(
            'dataOsSports',
            'dataOddsFeed',
            'dataAllSports',
            'dataSportRadar',
            'mappings',
            'table')
        );
    }

    public function store(Request $request)
    {
        $mappingsInput = $request->input('mapping', []);

        foreach ($mappingsInput['allsport'] as $ossportId => $allsportId) {

            $oddsfeedId = $mappingsInput['oddsfeed'][$ossportId] ?? null;

            $sportradarId = $mappingsInput['sportradar'][$ossportId] ?? null;

            DataMapping::updateOrCreate(
                [
                    'ossport_table_id' => $ossportId,
                    'table_name' => 'categories'
                ],
                [
                    'allsport_table_id' => $allsportId,
                    'oddsfeed_table_id' => $oddsfeedId,
                    'sportradar_table_id' => $sportradarId
                ]
            );
        }

        return redirect()->back()->with('success', 'Mapiranja su sačuvana.');
    }

    public function autoMap(string $table)
    {
        /** @var BaseModel $modelA */
        $modelA = 'App\Models\\'.ucfirst($table);
        /** @var BaseModel $modelB */
        $modelB = 'App\Models\Tipster\\'.ucfirst($table).'Tipster';

        if (! class_exists($modelA) || ! class_exists($modelB)) {
            abort(404, 'Model not found.');
        }

        $dataA = $modelA::all();
        $dataB = $modelB::all();

        $dataBMap = $dataB->keyBy(function ($item) {
            return strtolower($item->name);
        });

        foreach ($dataA as $itemA) {
            $key = strtolower($itemA->name);
            if (isset($dataBMap[$key])) {
                DataMapping::updateOrCreate(
                    ['source_id' => $itemA->id, 'table_name' => 'sports'],
                    ['tipster_table_id' => $dataBMap[$key]->id]
                );
            }
        }

        return redirect()->back()->with('success', 'Automatska mapiranja su sačuvana.');
    }
}
