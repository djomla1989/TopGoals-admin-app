<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\BaseModel;
use App\Models\DataMapping;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class MappingController extends Controller
{
    public function index(string $table): View
    {
        /** @var BaseModel $modelA */
        $modelA = 'App\Models\\'.ucfirst(Str::singular($table));
        /** @var BaseModel $modelB */
        $modelB = 'App\Models\Tipster\\'.ucfirst(Str::singular($table)).'Tipster';

        if (! class_exists($modelA) || ! class_exists($modelB)) {
            abort(404, 'Model not found.');
        }

        $dataA = $modelA::all();
        $dataB = $modelB::all();

        $mappings = DataMapping::where('table_name', $table)->get()->keyBy('source_id');

        return view('mapping.index', compact('dataA', 'dataB', 'mappings', 'table'));
    }

    public function store(Request $request, $table)
    {
        $mappingsInput = $request->input('mapping', []);

        foreach ($mappingsInput as $sourceAId => $sourceBId) {
            if (! empty($sourceBId)) {
                DataMapping::updateOrCreate(
                    ['source_id' => $sourceAId, 'table_name' => $table], ['tipster_table_id' => $sourceBId]
                );
            }
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
