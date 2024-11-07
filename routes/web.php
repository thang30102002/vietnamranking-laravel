<?php

use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [RankingController::class, 'index'])->name('ranking.home');
Route::get('/ranking', [RankingController::class, 'ranking'])->name('ranking.ranking');
Route::get('/detail/{id}', [RankingController::class, 'detail'])->name('ranking.detail')->where('id', '[0-9]+');
