<?php

use App\Http\Middleware\CreateStaffValidate;
use App\Http\Middleware\DeparmentValidate;
use App\Http\Middleware\EditStaffValidate;
use App\Http\Middleware\ShiftMiddleware;
use App\Http\Middleware\StaffValidate;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            "validate.create.staff" => CreateStaffValidate::class,
            "validate.edit.staff" => EditStaffValidate::class,
            "validate.department" => DeparmentValidate::class,
            "validate.shift" => ShiftMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
