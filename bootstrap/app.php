<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Models\ResponseModel;
use Illuminate\Auth\AuthenticationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // 
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // handle Not Found exception
        $exceptions->render(function (NotFoundHttpException $e) {
            $resModel = new ResponseModel('error', $e->getMessage(), null);
            return response()->json($resModel, 404);
        });

        // handle Method Not Allowed exception
        $exceptions->render(function (MethodNotAllowedHttpException $e) {
            $resModel = new ResponseModel('error', $e->getMessage(), null);
            return response()->json($resModel, 405);
        });

        // handle Authentication exception
        $exceptions->render(function (AuthenticationException $e) {
            $resModel = new ResponseModel('error', $e->getMessage(), null);
            return response()->json($resModel, 401);
        });

        // handle other exceptions
        $exceptions->render(function (Throwable $e) {
            $resModel = new ResponseModel('error', $e->getMessage(), null);
            return response()->json($resModel, 500);
        });

    })->create();
