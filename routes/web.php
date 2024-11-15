<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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
    dd($tournamentMeta);

    return 'test';
});
