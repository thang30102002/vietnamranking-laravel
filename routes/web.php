<?php

use App\Http\Controllers\RankingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ranking', [RankingController::class, 'index'])->name('ranking.index');
