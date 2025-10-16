<?php

use App\Http\Controllers\AdminTournamentController;
use App\Http\Controllers\RankingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\NotificationController;

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
Route::get('/tournament/bracket/{tournamentId}', [RankingController::class, 'tournament_bracket'])->name('ranking.tournament_bracket');


// Public news routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::middleware('is_player')->group(function () {
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('/posts', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts/edit/{postId}', [PostController::class, 'edit'])->name('posts.edit');
    Route::post('/posts/delete/{postId}', [PostController::class, 'delete'])->name('posts.delete');
    Route::get('/posts/{postId}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/like/{postId}', [PostController::class, 'like'])->name('posts.like');
    Route::post('/posts/comment/{postId}', [PostController::class, 'comment'])->name('posts.comment');
    Route::get('/player-posts/{id}', [PostController::class, 'getPlayerPost'])->name('posts.getPlayerPost');
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
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
        Route::post('/adminTournament/addPlayerRegister/{id_tournament}', [AdminTournamentController::class, 'addPlayerRegister'])->name('adminTournament.addPlayerRegister');
        Route::get('/adminTournament/bracket/{id_tournament}', [AdminTournamentController::class, 'bracket'])->name('adminTournament.bracket');
    }
);

Route::middleware('is_admin')->group(
    function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin', [AdminController::class, 'update'])->name('admin.update');

        Route::get('/admin/users', [AdminController::class, 'showUser'])->name('admin.showUser');
        Route::get('/admin/admin-tournament', [AdminController::class, 'showAdminTournament'])->name('admin.showAdminTournament');
        Route::get('/admin/edit-player/{id}', [AdminController::class, 'showEditUser'])->name('admin.showEditUser');
        Route::post('/admin/edit-player/{id}', [AdminController::class, 'updatePlayer'])->name('admin.updatePlayer');
        Route::delete('/admin/delete', [AdminController::class, 'deletePlayer'])->name('admin.deletePlayer');

// Admin news routes
Route::prefix('admin/news')->name('admin.news.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminNewsController::class, 'dashboard'])->name('dashboard');
    Route::get('/', [App\Http\Controllers\AdminNewsController::class, 'index'])->name('index');
    Route::get('/create', [App\Http\Controllers\AdminNewsController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\AdminNewsController::class, 'store'])->name('store');
    Route::get('/{id}/edit', [App\Http\Controllers\AdminNewsController::class, 'edit'])->name('edit');
    Route::put('/{id}', [App\Http\Controllers\AdminNewsController::class, 'update'])->name('update');
    Route::delete('/{id}', [App\Http\Controllers\AdminNewsController::class, 'destroy'])->name('destroy');
    Route::post('/upload-image', [App\Http\Controllers\AdminNewsController::class, 'uploadImage'])->name('upload-image');
});
        
        // Admin categories routes
        Route::prefix('admin/categories')->name('admin.categories.')->group(function () {
            Route::get('/', [App\Http\Controllers\CategoryController::class, 'index'])->name('index');
            Route::get('/create', [App\Http\Controllers\CategoryController::class, 'create'])->name('create');
            Route::post('/', [App\Http\Controllers\CategoryController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [App\Http\Controllers\CategoryController::class, 'edit'])->name('edit');
            Route::put('/{id}', [App\Http\Controllers\CategoryController::class, 'update'])->name('update');
            Route::delete('/{id}', [App\Http\Controllers\CategoryController::class, 'destroy'])->name('destroy');
            Route::post('/{id}/toggle-status', [App\Http\Controllers\CategoryController::class, 'toggleStatus'])->name('toggle-status');
        });
        
        // Legacy routes for backward compatibility
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
