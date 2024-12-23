<?php

use App\Http\Controllers\AdminTournamentController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPlayerRole;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;

// Route::get('/', function () {
//     return view('home');
// });
Route::get('/', [RankingController::class, 'index'])->name('ranking.index');

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/home', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/ranking', [RankingController::class, 'ranking'])->name('ranking.ranking');
Route::get('/detail/{id}', [RankingController::class, 'detail'])->name('ranking.detail');
Route::get('/tournament_organizer', [RankingController::class, 'tournament_organizer'])->name('ranking.tournament_organizer');
Route::get('/tournament', [RankingController::class, 'tournament'])->name('ranking.tournament');
Route::get('/register_tournament/{tournament_id}', [RankingController::class, 'register_tournament'])->name('ranking.register_tournament')->middleware('register_tournament');
Route::post('/register_tournament/{tournament_id}', [RankingController::class, 'register_tournament_success'])->name('ranking.register_tournament_success')->middleware('register_tournament');




Route::middleware('is_admin_tournament')->group(
    function () {
        Route::get('/adminTournament', [AdminTournamentController::class, 'index'])->name('adminTournament.index');
        Route::get('/adminTournament/profile', [AdminTournamentController::class, 'profile'])->name('adminTournament.profile');
        Route::get('/adminTournament/add_tournament', [AdminTournamentController::class, 'get_add'])->name('adminTournament.addtournament');
        Route::get('/adminTournament/add_tournament', [AdminTournamentController::class, 'get_add'])->name('adminTournament.addtournament');
        Route::post('/adminTournament/add_tournament', [AdminTournamentController::class, 'add_tournament']);
        Route::get('/adminTournament/tournaments', [AdminTournamentController::class, 'showAllTournament'])->name('adminTournament.showAllTournament');
        Route::delete('/adminTournament/{id}', [AdminTournamentController::class, 'destroy'])->name('adminTournament.destroy');
        Route::get('/adminTournament/edit_tournament/{id}', [AdminTournamentController::class, 'showEditTournament'])->name('adminTournament.showEditTournament');
        Route::put('/adminTournament/edit_tournament/{id}', [AdminTournamentController::class, 'editTournament'])->name('adminTournament.editTournament');
        Route::get('/adminTournament/edit-player/{id}', [AdminTournamentController::class, 'showEditPlayer'])->name('adminTournament.showEditPlayer');
        Route::post('/adminTournament/edit-player/{id}', [AdminTournamentController::class, 'editPlayer'])->name('adminTournament.editPlayer');

    }
);

Route::middleware('is_admin')->group(
    function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin', [AdminController::class, 'update'])->name('admin.update');
    }
);

require __DIR__ . '/auth.php';
