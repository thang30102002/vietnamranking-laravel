<?php

use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [RankingController::class, 'index'])->name('home.index');
Route::get('/ranking', [RankingController::class, 'ranking'])->name('ranking.index');
