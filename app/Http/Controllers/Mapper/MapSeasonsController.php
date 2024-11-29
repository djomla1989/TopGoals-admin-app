<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\DataMapping;
use App\Models\Tournament;

class MapSeasonsController extends Controller
{
    public function index()
    {
        $mappedCategories = DataMapping::where('table_name', 'categories')->get()->keyBy('source_id');

        $tournamentList = [];

        foreach ($mappedCategories as $category) {
            $tournament = Tournament::find($category->source_id);
            $tournamentList[$category->source_id] = $tournament;
        }

        dd($tournamentList);
    }
}
