<?php

use App\Http\Controllers\CovidController;

Route::get('/', [CovidController::class, 'index'])->name('home');
Route::get('/covid-data/{country}', [CovidController::class, 'getCovidData'])->name('covid.data');