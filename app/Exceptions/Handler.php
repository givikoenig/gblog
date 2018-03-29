<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

// use Illuminate\Support\Arr;
// use Whoops\Handler\PrettyPageHandler;
// use Illuminate\Filesystem\Filesystem;

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

    // protected function whoopsHandler()
    //     {
    //         return tap(new PrettyPageHandler, function ($handler) {
    //             $files = new Filesystem;
    //             $handler->setEditor('sublime');
    //             $handler->handleUnconditionally(true);
    //             $handler->setApplicationPaths(
    //                 array_flip(Arr::except(
    //                     array_flip($files->directories(base_path())), [base_path('vendor')]
    //                 ))
    //             );
    //         });
    //     }

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        return parent::render($request, $exception);
        // if ($this->isHttpException($exception)) 
        // {
        //     switch ($exception->getStatusCode()) 
        //     {
        //         case 404:
        //             return redirect()->route('404');
        //         break;
        //         default:
        //             return $this->renderHttpException($exception);
        //         break;
        //     }
        // }
        // else 
        // {
        //     return parent::render($request, $exception);
        // }
    }


}
