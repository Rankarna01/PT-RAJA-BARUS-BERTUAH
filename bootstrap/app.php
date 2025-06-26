<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        
        // 1. Aktifkan file routes/api.php untuk webhook
        api: __DIR__.'/../routes/api.php', 

        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 2. Daftarkan pengecualian CSRF untuk webhook Midtrans
        // Ini adalah cara baru menggantikan properti $except di VerifyCsrfToken.php
        $middleware->validateCsrfTokens(except: [
            'midtrans-webhook',
        ]);
        
        // 3. Daftarkan alias middleware Anda
        $middleware->alias([
            'is.admin' => \App\Http\Middleware\IsAdmin::class,
            'is.pelanggan' => \App\Http\Middleware\IsPelanggan::class,
        ]);

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();