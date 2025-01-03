<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\AllSports\CategoryAllSports;
use App\Models\DataMapping;
use App\Models\OsSport\CategoryOsSport;
use App\Models\SportRadar\CategorySportRadar;
use App\Models\Tipster\CategoryTipster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class MappingCategory extends Controller
{
    public function index(): View
    {
        $table = 'categories';

        // Sve podatke dohvatamo odjednom
        $dataOsSports   = CategoryOsSport::all();          // ~200
        $dataAllSports  = CategoryAllSports::all();                 // ~200
        $dataOddsFeed   = CategoryTipster::all();          // ~200
        $dataSportRadar = CategorySportRadar::orderBy('name')->get(); // ~200

        // Dohvatimo postojeća mapiranja
        // keyBy('ossport_table_id') da bismo ih lako pristupili kasnije
        $mappings = DataMapping::where('table_name', $table)->get()->keyBy('ossport_table_id');

        /**
         * 1) Napravimo MAP-e za brze provere.
         *    Na primer, $allSportsMapByName['tenis'] = Category(ID=123)
         *    Ovo vam omogućava da u O(1) pronađete da li postoji Category sa name/slug 'tenis'.
         */
        $allSportsMapByName = $dataAllSports->keyBy(function($item) {
            return strtolower($item->name);
        });
        $allSportsMapBySlug = $dataAllSports->keyBy(function($item) {
            return strtolower($item->slug);
        });

        $oddsFeedMapByName = $dataOddsFeed->keyBy(function($item) {
            return strtolower($item->name);
        });
        $oddsFeedMapBySlug = $dataOddsFeed->keyBy(function($item) {
            return strtolower($item->slug);
        });

        $sportRadarMapByName = $dataSportRadar->keyBy(function($item) {
            return strtolower($item->name);
        });
        $sportRadarMapBySlug = $dataSportRadar->keyBy(function($item) {
            return strtolower($item->slug);
        });

        /**
         * 2) Prođemo kroz svaki OS Sport i pripremimo sve što treba za prikaz u Blade-u.
         *    Umesto da radimo "if (nema) { foreach(...) }", ovde sve rešavamo lookup-om u Mapi.
         */
        $mappedData = [];

        foreach ($dataOsSports as $osSport) {

            $selectedAllSports    = $mappings[$osSport->import_id]['allsport_table_id']    ?? null;
            $selectedOddsFeed     = $mappings[$osSport->import_id]['oddsfeed_table_id']    ?? null;
            $selectedSportRadar   = $mappings[$osSport->import_id]['sportradar_table_id']  ?? null;

            $isAutoMappedAllSports  = false;
            $isAutoMappedOddsFeed   = false;
            $isAutoMappedSportRadar = false;

            // Ako nije ručno mapirano, pokušavamo auto-map:
            if (is_null($selectedAllSports)) {
                $name = strtolower($osSport->name);
                $slug = strtolower($osSport->slug);

                if (isset($allSportsMapByName[$name])) {
                    $selectedAllSports = $allSportsMapByName[$name]->import_id;
                    $isAutoMappedAllSports = true;
                } elseif (isset($allSportsMapBySlug[$slug])) {
                    $selectedAllSports = $allSportsMapBySlug[$slug]->import_id;
                    $isAutoMappedAllSports = true;
                }
            }

            if (is_null($selectedOddsFeed)) {
                $name = strtolower($osSport->name);
                $slug = strtolower($osSport->slug);

                if (isset($oddsFeedMapByName[$name])) {
                    $selectedOddsFeed = $oddsFeedMapByName[$name]->import_id;
                    $isAutoMappedOddsFeed = true;
                } elseif (isset($oddsFeedMapBySlug[$slug])) {
                    $selectedOddsFeed = $oddsFeedMapBySlug[$slug]->import_id;
                    $isAutoMappedOddsFeed = true;
                }
            }

            if (is_null($selectedSportRadar)) {
                $name = strtolower($osSport->name);
                $slug = strtolower($osSport->slug);

                if (isset($sportRadarMapByName[$name])) {
                    $selectedSportRadar = $sportRadarMapByName[$name]->import_id;
                    $isAutoMappedSportRadar = true;
                } elseif (isset($sportRadarMapBySlug[$slug])) {
                    $selectedSportRadar = $sportRadarMapBySlug[$slug]->import_id;
                    $isAutoMappedSportRadar = true;
                }
            }

            // Ubacimo sve za jedan red u $mappedData
            $mappedData[] = [
                'osSport'                 => $osSport,
                'selectedAllSports'       => $selectedAllSports,
                'selectedOddsFeed'        => $selectedOddsFeed,
                'selectedSportRadar'      => $selectedSportRadar,
                'isAutoMappedAllSports'   => $isAutoMappedAllSports,
                'isAutoMappedOddsFeed'    => $isAutoMappedOddsFeed,
                'isAutoMappedSportRadar'  => $isAutoMappedSportRadar,
            ];
        }

        /**
         * 3) Prosledimo "obrađeni" $mappedData u view, zajedno sa listama
         *    (za generisanje <option> u <select>) i mapama.
         */
        return view('mapping.category', compact(
            'mappedData',
            'dataAllSports',
            'dataOddsFeed',
            'dataSportRadar',
            'mappings',
            'table'
        ));
    }

    /**
     * Cuvanje mapiranja ostaje isto.
     */
    public function store(Request $request)
    {
        $mappingsInput = $request->input('mapping', []);

        foreach ($mappingsInput['allsport'] as $ossportId => $allsportId) {
            $oddsfeedId   = $mappingsInput['oddsfeed'][$ossportId] ?? null;
            $sportradarId = $mappingsInput['sportradar'][$ossportId] ?? null;

            DataMapping::updateOrCreate(
                [
                    'ossport_table_id' => $ossportId,
                    'table_name' => 'categories'
                ],
                [
                    'allsport_table_id'   => $allsportId,
                    'oddsfeed_table_id'   => $oddsfeedId,
                    'sportradar_table_id' => $sportradarId
                ]
            );
        }

        Session::flash('message', 'Category mapping saved.');
        return redirect()->back()->with('success', 'Mapiranja su sačuvana.');
    }

    /**
     * Primer autoMap metode – ostaje nepromenjeno,
     * ili prepravite po želji.
     */
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
