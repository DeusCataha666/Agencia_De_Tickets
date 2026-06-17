<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use App\Exceptions\NotFoundHttpException;
use App\Exceptions\ForbiddenHttpException;
use App\Exceptions\InternalServerErrorException;
use App\Exceptions\SessionExpiredException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontReport = [
        //
    ];

    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        // Dejar que Laravel maneje las excepciones de validación normalmente
        // (redirige de vuelta con los errores en sesión)
        if ($exception instanceof \Illuminate\Validation\ValidationException) {
            return parent::render($request, $exception);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
            return (new NotFoundHttpException())->render($request);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException) {
            return (new ForbiddenHttpException())->render($request);
        }

        if ($exception instanceof \Illuminate\Session\TokenMismatchException) {
            return (new SessionExpiredException())->render($request);
        }

        if ($exception instanceof \Symfony\Component\HttpKernel\Exception\HttpException && $exception->getStatusCode() == 500) {
            return (new InternalServerErrorException())->render($request);
        }

        return parent::render($request, $exception);
    }
}