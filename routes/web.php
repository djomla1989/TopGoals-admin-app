<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use MongoDB\Laravel\Connection;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {

    /** @var Connection $conn */
    $conn = DB::connection('mongodb');
    dd($conn->table('managers')->first());

    return 'test';
});
