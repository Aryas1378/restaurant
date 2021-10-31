<?php

namespace App\Exceptions;

use Dflydev\DotAccessData\Exception\MissingPathException;
use Facade\FlareClient\Http\Exceptions\MissingParameter;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Routing\Exceptions\UrlGenerationException;
use Illuminate\Validation\ValidationException;
use Laravel\SerializableClosure\Exceptions\MissingSecretKeyException;
use Symfony\Component\Translation\Exception\MissingRequiredOptionException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $e)
    {

        if ($e instanceof AuthorizationException) {
            return response()->json([
                'message' => 'unauthorized'
            ], 403);
        }

        if ($e instanceof ValidationException) {
            return response()->json([
                'message' => "not valid request"
            ], 401);
        }

        return response()->json([
            'message' => $e->getMessage(),
        ], 400);
    }
}
