<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTournament;


Route::post('/tournament/bracket/{tournamentId}', [ApiTournament::class, 'postBracket'])->name('tournament.postBracket');
Route::post('/tournament/delete-bracket/{tournamentId}', [ApiTournament::class, 'deleteBracket'])->name('tournament.deleteBracket');