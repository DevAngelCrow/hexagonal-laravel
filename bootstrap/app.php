<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Src\shared\infrastructure\HttpResponses;
use Src\shared\domain\DomainException;
use Src\shared\infrastructure\exceptions\InfrastructureException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //Excepciones para el dominio;
        $exceptions->renderable(function (DomainException $e, $request) {
            //echo $e;
            $responder = new class {
            use HttpResponses; 
        };
            //if ($request->expectsJson()) {
                $details = [];
                if (config("app.debug")) {
                    $details = [
                        "exception_type" => get_class($e),
                        "file" => $e->getFile(),
                        "line" => $e->getLine(),
                        "trace" => explode("\n", $e->getTraceAsString())
                    ];
                }

                //$errorCode = $e->getErrorCode();
                $httpStatusCode = $e->getHttpStatusCode();
                
                switch ($httpStatusCode) {
                    case Response::HTTP_BAD_REQUEST:
                        return $responder->badRequest($e->getMessage(), $details);
                    case Response::HTTP_UNAUTHORIZED:
                        return $responder->unauthorized($e->getMessage(), $details);
                    case Response::HTTP_FORBIDDEN:
                        return $responder->forbiden($e->getMessage(), $details);
                    case Response::HTTP_NOT_FOUND:
                        return $responder->notFound($e->getMessage(), $details);
                    case Response::HTTP_METHOD_NOT_ALLOWED:
                        return $responder->methodNotAllowed($e->getMessage(), $details);
                    case Response::HTTP_TOO_MANY_REQUESTS:
                        return $responder->tooManyRequest($e->getMessage(), $details);
                    case Response::HTTP_UNPROCESSABLE_ENTITY:
                        // Este es el caso común para errores de validación de negocio
                        return $responder->unprocesableEntity($e->getMessage(), $details);
                    case Response::HTTP_INTERNAL_SERVER_ERROR:
                        // Si tu DomainException indica un error interno del dominio (ej. un fallo de consistencia)
                        return $responder->internalServerError($e->getMessage(), $details);
                    default:
                        return $responder->internalServerError(
                            config('app.debug') ? $e->getMessage() : 'Ocurrió un error inesperado en el dominio.',
                            $details,
                            //$errorCode ?: 'UNHANDLED_DOMAIN_ERROR'
                        );
                }
            //}
            return back()->withErrors(["error" => $e->getMessage()])->withInput();
        });

        //Excepciones de infraestructura;

        $exceptions->renderable(function (InfrastructureException $e, $request) {
            $responder = new class {
            use HttpResponses; 
        };
            //if ($request->expectsJson()) {
                $details = [];
                if (config("app.debug")) {
                    $details = [
                        "exception_type" => get_class($e),
                        "file" => $e->getFile(),
                        "line" => $e->getLine(),
                        "trace" => explode("\n", $e->getTraceAsString())
                    ];
                }

                //$errorCode = $e->getErrorCode();
                $httpStatusCode = $e->getHttpStatusCode();
                
                switch ($httpStatusCode) {
                    case Response::HTTP_BAD_REQUEST:
                        return $responder->badRequest($e->getMessage(), $details);
                    case Response::HTTP_UNAUTHORIZED:
                        return $responder->unauthorized($e->getMessage(), $details);
                    case Response::HTTP_FORBIDDEN:
                        return $responder->forbiden($e->getMessage(), $details);
                    case Response::HTTP_NOT_FOUND:
                        return $responder->notFound($e->getMessage(), $details);
                    case Response::HTTP_METHOD_NOT_ALLOWED:
                        return $responder->methodNotAllowed($e->getMessage(), $details);
                    case Response::HTTP_TOO_MANY_REQUESTS:
                        return $responder->tooManyRequest($e->getMessage(), $details);
                    case Response::HTTP_UNPROCESSABLE_ENTITY:
                        // Este es el caso común para errores de validación de negocio
                        return $responder->unprocesableEntity($e->getMessage(), $details);
                    case Response::HTTP_INTERNAL_SERVER_ERROR:
                        // Si tu DomainException indica un error interno del dominio (ej. un fallo de consistencia)
                        return $responder->internalServerError($e->getMessage(), $details);
                    default:
                        return $responder->internalServerError(
                            config('app.debug') ? $e->getMessage() : 'Ocurrió un error inesperado en el dominio.',
                            $details,
                            //$errorCode ?: 'UNHANDLED_DOMAIN_ERROR'
                        );
                }
            //}
            return back()->withErrors(["error" => $e->getMessage()])->withInput();
        });

        // también puedes capturar Throwable si quieres un fallback general
        // $exceptions->renderable(function (Throwable $e, Request $request) {
        //     $responder = new class {
        //         use HttpResponses;
        //     };

        //     $details = config('app.debug') ? [
        //         'exception_type' => get_class($e),
        //         'message' => $e->getMessage(),
        //         'file' => $e->getFile(),
        //         'line' => $e->getLine(),
        //         'trace' => explode("\n", $e->getTraceAsString()),
        //     ] : [];

        //     return $responder->internalServerError(
        //         config('app.debug') ? $e->getMessage() : 'Error inesperado.',
        //         $details,
        //         //"SERVER_ERROR"
        //     );
        // });
    })->create();
