<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TrafficController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/sites/create', [SiteController::class, 'create'])->name('sites.create');
Route::post('/sites', [SiteController::class, 'store'])->name('sites.store');

Route::get('/tracking-data', [TrafficController::class, 'index']);
