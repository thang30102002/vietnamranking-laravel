<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiTournament;


Route::post('/tournament/bracket/{tournamentId}', [ApiTournament::class, 'postBracket'])->name('tournament.postBracket');