<?php

use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/ranking', [RankingController::class, 'ranking'])->name('ranking.ranking');
Route::get('/detail/{id}', [RankingController::class, 'detail'])->name('ranking.detail');
Route::get('/tournament_organizer', [RankingController::class, 'tournament_organizer'])->name('ranking.tournament_organizer');
Route::get('/tournament', [RankingController::class, 'tournament'])->name('ranking.tournament');

require __DIR__ . '/auth.php';
