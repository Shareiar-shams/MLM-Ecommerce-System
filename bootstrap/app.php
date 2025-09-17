<?php

use App\Http\Middleware\AdminAuth;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use App\Exceptions\ErrorConfiguration;
use Illuminate\Support\Facades\Log;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // $middleware->append(AdminAuth::class);
        $middleware->alias([
            'admin' => AdminAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {
            $statusCode = $e instanceof HttpExceptionInterface
                ? $e->getStatusCode()
                : ($e->getCode() && $e->getCode() >= 100 && $e->getCode() < 600
                    ? $e->getCode()
                    : 500);
            $errorMessage = $e->getMessage();
            $errorFile    = $e->getFile();
            $errorLine    = $e->getLine();

            Log::error("Exception: {$errorMessage} in {$errorFile} on line {$errorLine}");

            $errorData = ErrorConfiguration::getErrorData($statusCode);
            
            $view = $errorData['view'] ?? ErrorConfiguration::getErrorView();
            return response()->view($view, [
                'statusCode' => $statusCode,
                'title' => $errorData['title'],
                'message' => "Exception: {$errorMessage} in {$errorFile} on line {$errorLine}" ?? $errorData['message'],
                'image' => $errorData['image'],
                'exception' => $e,
            ], $statusCode);
        });
    })->create();
