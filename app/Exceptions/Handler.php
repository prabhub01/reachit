<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Exception;

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
        /**
         * Added on: Jan 15, 2021.
         */
        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($request, $e);
        });

        $this->reportable(function (Throwable $e) {
        });
    }

    public function handleException($request, Exception $exception)
    {
        if ((request()->segment(1) == 'system' || request()->segment(1) == 'admin') && $exception->getMessage() == 'Unauthenticated.') {
            if (!(auth()->guard('admin')->check())) {
                return redirect()->route('admin.login');
            } elseif (!(auth()->guard('admin')->check())) {
                return redirect()->route('home');
            }
        }
        if ((request()->segment(1) == 'user' || request()->segment(1) == 'login') && $exception->getMessage() == 'Unauthenticated.') {
            if (!(auth()->guard('user')->check())) {
                return redirect()->route('user.login');
            } elseif (!(auth()->guard('user')->check())) {
                return redirect()->route('home');
            }
        }

        $this->reportable(function (Throwable $e) {
            //
        });
    }

}
