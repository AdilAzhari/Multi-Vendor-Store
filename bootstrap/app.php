<?php

use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\MarkNorificationAsRead;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use PhpParser\Node\Stmt\TraitUseAdaptation\Alias;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['Auth-login'=> CheckLogin::class,
        'MarkNorificationAsRead' => MarkNorificationAsRead::class,
    ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->withEvents(discover:[
        __DIR__.'/../app/Events',
        __DIR__.'/../app/listeners',
        ])
    ->create();
