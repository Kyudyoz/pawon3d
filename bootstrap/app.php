<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Spatie\Permission\Middleware\PermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->alias([
            'permission' => PermissionMiddleware::class,
        ]);

        // Redirect authenticated users to dashboard instead of home
        $middleware->redirectGuestsTo('/login');
        $middleware->redirectUsersTo('/dashboard');

        // Exclude test-only endpoints dari CSRF verification
        $middleware->validateCsrfTokens(except: [
            'test/login',
            'test/stock-reset',
            'test/concurrent-buy',
            'test/material-batch-reset',
            'test/concurrent-produce',
            'test/atomicity-buy',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
