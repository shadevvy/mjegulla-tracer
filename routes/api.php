<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrafficController;

Route::post('/track', [TrafficController::class, 'track']);
