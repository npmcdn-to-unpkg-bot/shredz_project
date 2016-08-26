<?php

namespace App\Exceptions;

use Log;
use Auth;
use Request;
use Exception;
use Illuminate\Session\TokenMismatchException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
        TokenMismatchException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $e
     * @return void
     */
    public function report(Exception $e)
    {
        // Add some extra context to non-404 errors
        if (!($this->isHttpException($e) && $e->getStatusCode() == '404')) {
            Log::error("File " . $e->getFile() . " Line " . $e->getLine());
            if (Request::fullUrl()) {
                Log::error("URL " . Request::fullUrl());
            }
            if (Auth::user()) {
                Log::error("User " . Auth::user()->id);
            }
        }
        if ($this->shouldReport($e)) {
            app('sentry')->captureException($e);
        }

        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($this->isHttpException($e)) {
            switch ($e->getStatusCode()) {
                case '404':
                    //first, look for a redirect
                    if ($redirect = \App\Http\Controllers\RedirectsController::maintainOldLinks($request)){
                        return $redirect;
                    }
                    $pathInfo = $request->getPathInfo();
                    $message = $e->getMessage() ?: 'Exception';
                    $previous = $request->headers->get('referer');

                    \Log::error($e->getStatusCode() . " - $message @ $pathInfo (ref: $previous)");
                    // \Log::error($e);
                    return redirect('/');
                    // return \Response::view('errors.404');
                    break;

                case '500':
                    \Log::error($e);
                    return redirect('/');
                    // return \Response::view('errors.500');
                    break;

                default:
                    return $this->renderHttpException($e);
                    break;
            }
        }

        if ($e instanceof ModelNotFoundException) {
            $e = new NotFoundHttpException($e->getMessage(), $e);
        }

        return parent::render($request, $e);
    }
}
