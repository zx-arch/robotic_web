<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

use Exception;
use Throwable;

class PagesException extends ExceptionHandler
{
    protected $dontReport = [];

    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    public function render($request, Throwable $exception)
    {
        return response()->view('errors.error', ['error' => $exception]);

    }
}