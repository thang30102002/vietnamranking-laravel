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

require __DIR__ . '/auth.php';
