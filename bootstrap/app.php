<?php

use Illuminate\Http\Request;
use App\Http\Middleware\AdminAccess;
use App\Http\Middleware\CheckAccess;
use App\Http\Middleware\EnhancedAnalyticsTracker;
use Illuminate\Session\TokenMismatchException;
use App\Http\Middleware\CheckCustomHeaders;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->validateCsrfTokens(except: [
            'webhook',
            'webhook/*',
        ]);
        $middleware->alias([
            'admin' => App\Http\Middleware\AdminAccess::class,
            'check.access' => App\Http\Middleware\CheckAccess::class,
            'custom.tracker' => App\Http\Middleware\EnhancedAnalyticsTracker::class,
            'check.custom.headers' => App\Http\Middleware\CheckCustomHeaders::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Request $request, Throwable $exception) {
            if ($exception instanceof NotFoundHttpException) {
                return response()->view('errors.404', [], 404);
            }

            if ($exception instanceof TokenMismatchException) {
                return response()->view('errors.419', [], 419);
            }

            if ($exception instanceof HttpException) {
                if ($exception->getStatusCode() == 403) {
                    return response()->view('errors.403', [], 403);
                }

                if ($exception->getStatusCode() == 500) {
                    return response()->view('errors.500', [], 500);
                }

                if ($exception->getStatusCode() == 503) {
                    return response()->view('errors.503', [], 503);
                }
            }

            return parent::render($request, $exception);
        });
    })->create();
