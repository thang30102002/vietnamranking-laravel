<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTournament;
use App\Http\Controllers\TournamentDataController;

Route::post('/tournament/bracket/{tournamentId}', [ApiTournament::class, 'postBracket'])->name('tournament.postBracket');
Route::post('/tournament/delete-bracket/{tournamentId}', [ApiTournament::class, 'deleteBracket'])->name('tournament.deleteBracket');

// Tournament Data API Routes
Route::prefix('tournament-data')->group(function () {
    Route::post('/save', [TournamentDataController::class, 'save'])->name('tournament-data.save');
    Route::get('/get/{tournamentId}', [TournamentDataController::class, 'get'])->name('tournament-data.get');
    Route::delete('/delete/{tournamentId}', [TournamentDataController::class, 'delete'])->name('tournament-data.delete');
    Route::put('/status/{tournamentId}', [TournamentDataController::class, 'updateStatus'])->name('tournament-data.updateStatus');
});