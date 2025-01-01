<?php

use App\Http\Controllers\Mapper\MappingCategory;
use App\Http\Controllers\Mapper\MapSeasonsController;
use App\Http\Controllers\Mapper\MapTournamentController;
use App\Http\Controllers\Mapper\MapTournamentSeasonsController;
use App\Services\DataImporters\Mappers\FuzzySearch;
use FuzzyWuzzy\Fuzz;
use FuzzyWuzzy\Process;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/test', function () {

        DB::connection('mongodb')->enableQueryLog();

        DB::listen(function ($query) {
            Log::debug('Mongo Query: '.json_encode($query->bindings));
        });

        $conn = DB::connection('mongodb');

        $tournamentMeta = $conn->table('categories')
            ->where('id', '1467')->get();

        $tournamentMeta = $conn->table('uniqueTournamentMeta')->where('uniqueTournament.id', 42)->get();

        return 'test';
    });

    Route::get('/connect', function (){
        $conn = DB::connection('mysqlSportRadar');
        $tournamentList = $conn->table('sports')->orderBy('name')->get();
        return $tournamentList;
    });

    Route::get('/map/category', [MappingCategory::class, 'index'])->name('mapping.category.index');
    Route::post('/map/category', [MappingCategory::class, 'store'])->name('mapping.category.store');
    Route::post('/map/category/auto', [MappingCategory::class, 'autoMap'])->name('mapping.category.auto');

    Route::get('/map/tournament', [MapTournamentController::class, 'index'])->name('mapping.tournament.index');
    Route::get('/map/tournament/{dataMapping}/{debug?}', [MapTournamentController::class, 'mapTournament'])->name('mapping.tournament.mapTournament');
    Route::post('/map/tournament/{dataMapping}', [MapTournamentController::class, 'store'])->name('mapping.tournament.store');
    Route::get('/map/seasons', [MapSeasonsController::class, 'index'])->name('mapping.seasons.index');

    Route::get('/map/seasons', [MapTournamentSeasonsController::class, 'index'])->name('mapping.tournament.season.index');
    Route::get('/map/seasons/{dataMapping}/{debug?}', [MapTournamentSeasonsController::class, 'mapSeason'])->name('mapping.tournament.season.mapSeason');
    Route::post('/map/seasons/{dataMapping}', [MapTournamentSeasonsController::class, 'store'])->name('mapping.tournament.season.store');
});
