<?php

use App\Http\Middleware\CheckPlayerRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\RegisterTournament;
use App\Http\Middleware\CheckAdminTournament;
use App\Http\Middleware\CheckAdmin;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
    $middleware->alias([
        'is_player' => CheckPlayerRole::class,
        'register_tournament' => RegisterTournament::class,
        'is_admin_tournament' => CheckAdminTournament::class,
        'is_admin' => CheckAdmin::class,
    ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
