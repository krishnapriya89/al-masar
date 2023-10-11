<?php

namespace App\Exceptions;

use Throwable;
use ErrorException;
use BadMethodCallException;
use Illuminate\Http\Response;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        if ($exception instanceof NotFoundHttpException || $exception instanceof ErrorException) {
            if ($request->is('admin/*')) {
                return response()->view('admin::errors.404', [], Response::HTTP_NOT_FOUND);
            } else {
                return response()->view('frontend::errors.404', [], Response::HTTP_NOT_FOUND);
            }
        }

        if ($exception instanceof HttpException && $exception->getStatusCode() === 500) {
            if ($request->is('admin/*')) {
                return response()->view('admin::errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            } else {
                return response()->view('frontend::errors.500', [], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }

        if ($exception instanceof ModelNotFoundException || $exception instanceof BadMethodCallException) {
            if ($request->is('admin/*')) {
                return response()->view('admin::errors.404', [], Response::HTTP_NOT_FOUND);
            } else {
                return response()->view('frontend::errors.404', [], Response::HTTP_NOT_FOUND);
            }
        }

        return parent::render($request, $exception);
    }
}
