<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

/**
 * The exception handler.
 */
class Handler extends ExceptionHandler
{
    /** @var array $dontReport A list of the exception types that are not reported. */
    protected $dontReport = [];

    /** @var array $dontFlash A list of the inputs that are never flashed for validation exceptions. */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param \Exception $exception The passed exception.
     *
     * @return void Returns nothing.
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request   The request passed.
     * @param \Exception               $exception The exception passed.
     *
     * @return \Illuminate\Http\Response Returns the HTML rendered response.
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
    }
}
