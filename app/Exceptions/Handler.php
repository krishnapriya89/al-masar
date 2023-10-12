<?php

namespace App\Exceptions;

use Throwable;
use ErrorException;
use BadMethodCallException;
use Illuminate\Http\Response;
use Sentry\Laravel\Integration;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            Integration::captureUnhandledException($e);
        });
    }

    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
        if ($exception instanceof NotFoundHttpException || $exception instanceof ErrorException) {
            if ($request->is('al-masar-admin-auth/*')) {
                return response()->view('admin::errors.404', [], Response::HTTP_NOT_FOUND);
            } else {
                return to_route('error.404');
            }
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() === 500) {
            if ($request->is('al-masar-admin-auth/*')) {
                return response()->view('admin::errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return to_route('error.500');
            }
        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof BadMethodCallException) {
            if ($request->is('al-masar-admin-auth/*')) {
                return response()->view('admin::errors.404', [], Response::HTTP_NOT_FOUND);
            } else {
                return to_route('error.404');
            }
        }

        return parent::render($request, $exception);
    }
}
