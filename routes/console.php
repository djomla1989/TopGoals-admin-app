<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

//Artisan::command('app:category-import', function () {
//    $this->comment('Import category');
//})->purpose('Import category');
//
//Artisan::command('app:import-tournaments', function () {
//    $this->comment('Import tournaments');
//})->purpose('Import tournaments');
//
//Artisan::command('app:tournament-sync', function () {
//    $this->comment('Syncing tournaments');
//})->purpose('Sync tournaments');
//
//Artisan::command('app:tournament-sync', function () {
//    $this->comment('Syncing tournaments');
//})->purpose('Sync tournaments');
//
//Artisan::command('app:tournament-season-create', function () {
//    $this->comment('Syncing tournaments season');
//})->purpose('Sync tournaments season');
//
//Artisan::command('app:season-matches', function () {
//    $this->comment('Syncing season matches');
//})->purpose('Sync season matches');

//Artisan::command('app:season-statistic', function () {
//    $this->comment('Syncing season statistic');
//})->purpose('Sync season statistic');

//Artisan::command('app:season-team-statistic', function () {
//    $this->comment('Syncing season team stats');//TODO: Implement this
//})->purpose('Sync season team stats');

//Artisan::command('app:season-standing', function () {
//    $this->comment('Syncing season standing');
//})->purpose('Sync season standing');


//Artisan::command('app:match-lineup', function () {
//    $this->comment('Syncing match lineups');
//})->purpose('Sync match lineups');

//Artisan::command('app:season-rounds', function () {
//    $this->comment('Syncing season rounds');
//})->purpose('Sync season rounds');

//Artisan::command('aapp:season-round-team-of-the-week', function () {
//    $this->comment('Syncing season round team of the week');
//})->purpose('Sync season round team of the week');

//Artisan::command('app:player-season-statistic-command', function () {
//    $this->comment('Syncing player season statistic');
//})->purpose('Syncing player season statistic');
