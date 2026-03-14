<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
    // Fungsi: Mengarahkan pengguna yang BELUM LOGIN (Guest) saat mencoba 
    // mengakses halaman yang diproteksi (pakai middleware 'auth').
    // 
    // Jadi, kalau ada orang iseng ngetik URL Dashboard tapi belum login, 
    // Laravel otomatis nendang mereka ke halaman '/Admin/Login' ini.
    $middleware->redirectGuestsTo('/');
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
