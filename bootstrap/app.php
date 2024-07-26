<?php

use App\Http\Middleware\AlwaysAcceptJson;
use App\Http\Middleware\CheckApiValidationToken;
use App\Http\Middleware\CheckLogin;
use App\Http\Middleware\MarkNorificationAsRead;
use App\Http\Middleware\SetAppLocalMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRoutes;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationRedirectFilter;
use Mcamara\LaravelLocalization\Middleware\LaravelLocalizationViewPath;
use Mcamara\LaravelLocalization\Middleware\LocaleCookieRedirect;
use Mcamara\LaravelLocalization\Middleware\LocaleSessionRedirect;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias(['Auth-login'=> CheckLogin::class,
        'MarkNorificationAsRead'  => MarkNorificationAsRead::class,
        'localize'                => LaravelLocalizationRoutes::class,
        'localizationRedirect'    => LaravelLocalizationRedirectFilter::class,
        'localeSessionRedirect'   => LocaleSessionRedirect::class,
        'localeCookieRedirect'    => LocaleCookieRedirect::class,
        'localeViewPath'          => LaravelLocalizationViewPath::class
    ]);
    $middleware->prependToGroup('api', [AlwaysAcceptJson::class,CheckApiValidationToken::class]);
    // $middleware->appendToGroup('web', [LocaleSessionRedirect::class, LocaleCookieRedirect::class]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (NotFoundHttpException $e, Request $request) {
            if ($request->wantsJson()) {
                return response()->json(['message' => 'Object not found'], 404);
            }
        });
    })->withEvents(discover:[
        __DIR__.'/../app/Events',
        __DIR__.'/../app/listeners',
        ])
    ->create();
