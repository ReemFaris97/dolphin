<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Http;
use Spatie\WebhookServer\WebhookCall;
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
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Throwable  $exception
     * @return void
     *
     * @throws \Throwable
     */
    public function report(Throwable $exception)
    {
        if ($this->shouldReport($exception)) {
            if (config('slackhooks.slack_hooks')){
                $hook= Http::post('https://hooks.slack.com/services/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',['username'=>'خازوق جديد','channel'=>'#ابو-الدلافين-باك-اند','text'=>$exception->getMessage().'\n'.$exception->getTraceAsString()]);
            }
        }
        return parent::report($exception);    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Throwable
     */
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
