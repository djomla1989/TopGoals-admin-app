<?php

namespace App\Http\Controllers\Mapper;

use App\Http\Controllers\Controller;
use App\Models\AllSports\TournamentAllSports;
use App\Models\DataMapping;

class MapSeasonsController extends Controller
{
    public function index()
    {
        $mappedCategories = DataMapping::where('table_name', 'categories')->get()->keyBy('source_id');

        $tournamentList = [];

        foreach ($mappedCategories as $category) {
            $tournament = TournamentAllSports::find($category->source_id);
            $tournamentList[$category->source_id] = $tournament;
        }

        dd($tournamentList);
    }
}
