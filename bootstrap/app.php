<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\EnergyController;
use App\Http\Controllers\API\MapController;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    // ->withMiddleware(function (Middleware $middleware) {
    //     $middleware->statefulApi();
    //     $middleware->api(append: [
    //         \Illuminate\Routing\Middleware\ThrottleRequests::class.':api',
    //         \Illuminate\Routing\Middleware\SubstituteBindings::class,
    //     ]);
    // })
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            \Illuminate\Http\Middleware\HandleCors::class,
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

