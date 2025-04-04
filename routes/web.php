<?php

use App\Http\Controllers\AdminTournamentController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckPlayerRole;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckAdmin;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;

Route::get('/', [RankingController::class, 'index']);

Route::get('/dashboard', function () {
    return redirect('/home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    // Route::post('/posts', [PostController::class, 'create'])->name('posts.create');
    // Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');
    // Route::post('/like/{postId}', [PostController::class, 'like'])->name('posts.like');
});
Route::get('/home', [RankingController::class, 'index'])->name('ranking.index');
Route::get('/ranking', [RankingController::class, 'ranking'])->name('ranking.ranking');
Route::get('/detail/{id}', [RankingController::class, 'detail'])->name('ranking.detail');
Route::get('/tournament_organizer', [RankingController::class, 'tournament_organizer'])->name('ranking.tournament_organizer');
Route::get('/tournament', [RankingController::class, 'tournament'])->name('ranking.tournament');
Route::get('/register_tournament/{tournament_id}', [RankingController::class, 'register_tournament'])->name('ranking.register_tournament')->middleware('register_tournament');
Route::post('/register_tournament/{tournament_id}', [RankingController::class, 'register_tournament_success'])->name('ranking.register_tournament_success')->middleware('register_tournament');
Route::post('/change-password', [RankingController::class, 'change_password'])->name('ranking.change_password');


Route::get('/news', [NewsController::class, 'index'])->name('news.index');

Route::middleware('is_player')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/edit/{postId}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/delete/{postId}', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/like/{postId}', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/comment/{postId}', [PostController::class, 'comment'])->name('posts.comment');
    Route::get('/player-posts/{id}', [PostController::class, 'getPlayerPost'])->name('posts.getPlayerPost');

});



Route::middleware('is_admin_tournament')->group(
    function () {
        Route::get('/adminTournament', [AdminTournamentController::class, 'index'])->name('adminTournament.index');
        Route::get('/adminTournament/profile', [AdminTournamentController::class, 'profile'])->name('adminTournament.profile');
        Route::get('/adminTournament/add_tournament', [AdminTournamentController::class, 'get_add'])->name('adminTournament.addtournament');
        Route::post('/adminTournament/add_tournament', [AdminTournamentController::class, 'add_tournament']);
        Route::get('/adminTournament/tournaments', [AdminTournamentController::class, 'showAllTournament'])->name('adminTournament.showAllTournament');
        Route::delete('/adminTournament/{id}', [AdminTournamentController::class, 'destroy'])->name('adminTournament.destroy');
        Route::get('/adminTournament/edit_tournament/{id}', [AdminTournamentController::class, 'showEditTournament'])->name('adminTournament.showEditTournament');
        Route::put('/adminTournament/edit_tournament/{id}', [AdminTournamentController::class, 'editTournament'])->name('adminTournament.editTournament');
        Route::get('/adminTournament/edit-player/{id}', [AdminTournamentController::class, 'showEditPlayer'])->name('adminTournament.showEditPlayer');
        Route::post('/adminTournament/edit-player/{id}', [AdminTournamentController::class, 'editPlayer'])->name('adminTournament.editPlayer');
        Route::post('/adminTournament/add-matches', [AdminTournamentController::class, 'addMatches'])->name('adminTournament.addMatches');
        Route::get('/adminTournament/edit-matches/{id}/{tournament_id}', [AdminTournamentController::class, 'showEditMatches'])->name('adminTournament.showEditMatches');
        Route::post('/adminTournament/edit-matches', [AdminTournamentController::class, 'editMatches'])->name('adminTournament.editMatches');
        Route::post('/adminTournament/delete-matches', [AdminTournamentController::class, 'deleteMatch'])->name('adminTournament.deleteMatch');
        Route::post('/adminTournament/updatePlayerRegisted/{id}', [AdminTournamentController::class, 'updatePlayerRegisted'])->name('adminTournament.updatePlayerRegisted');
        Route::post('/adminTournament/updatePlayerWin/{id}', [AdminTournamentController::class, 'updatePlayerWin'])->name('adminTournament.updatePlayerWin');
    }
);

Route::middleware('is_admin')->group(
    function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin', [AdminController::class, 'update'])->name('admin.update');

        Route::get('/admin/users', [AdminController::class, 'showUser'])->name('admin.showUser');
        Route::get('/admin/edit-player/{id}', [AdminController::class, 'showEditUser'])->name('admin.showEditUser');
        Route::post('/admin/edit-player/{id}', [AdminController::class, 'updatePlayer'])->name('admin.updatePlayer');
        Route::delete('/admin/delete', [AdminController::class, 'deletePlayer'])->name('admin.deletePlayer');

        Route::get('/showAllNews', [NewsController::class, 'showAll'])->name('news.showAll');
        Route::get('/showCreate', [NewsController::class, 'showCreate'])->name('news.showCreate');
        Route::get('/showEdit/{id}', [NewsController::class, 'showEdit'])->name('news.showEdit');
        Route::post('/news', [NewsController::class, 'create'])->name('news.create');
        Route::put('/editNews/{id}', [NewsController::class, 'store'])->name('editNews.store');
        Route::delete('/news/{id}', [NewsController::class, 'delete'])->name('news.delete');
        Route::post('/change-password-user', [AdminController::class, 'change_password_user'])->name('ranking.change_password_user');
    }
);

require __DIR__ . '/auth.php';
