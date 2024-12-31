<?php

use App\Http\Controllers\CovidController;
use Illuminate\Support\Facades\Route;

Route::get('/covid', [CovidController::class, 'index']);
Route::post('/covid', [CovidController::class, 'fetchData']);
