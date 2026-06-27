<?php

namespace App\Exceptions;

use App\Traits\Response;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Spatie\Permission\Exceptions\UnauthorizedException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    use Response;

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
        $this->reportable(function (Throwable $exception) {
            //
        });

        $this->renderable(function (UnauthorizedException $exception, $request) {
            return $this->unauthorizedResponse();
        });

        $this->renderable(function (ThrottleRequestsException $exception, $request) {
            if ($request->expectsJson()) {
                return $this->errorResponse(null, trans('messages.throttle_requests_exception', ['max' => 30]), $exception->getStatusCode());
            }
            //
        });

        $this->renderable(function (NotFoundHttpException $exception, $request) {
            if ($request->expectsJson()) {
                return $this->errorResponse(null, trans('messages.not_found_http_exception'), Response::$NOT_FOUND);
            }
            //
        });
    }

}
