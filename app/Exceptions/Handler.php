<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
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
     * @throws \Exception
     */
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

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
        if ($exception instanceof ValidationException) {
            // 只读取错误中的第一个错误信息
            $errors  = $exception->errors();
            $message = '';
            // 框架返回的是二维数组，因此需要去循环读取第一个数据
            foreach ($errors as $key => $val) {
                $keys    = array_key_first($val);
                $message = $val[$keys];
                break;
            }

            return response()->json(['code' => 1, 'msg' => $message, 'data' => []]);
        }

        if ($exception instanceof WebValidatorException) {
            return redirect()->to(url()->previous())->withInput($exception->getData())->withErrors($exception->getMessage());
        }

        if ($exception instanceof JsonValidatorException) {
            return response()->json(['code' => 1, 'msg' => $exception->getMessage(), 'data' => []]);
        }

        return parent::render($request, $exception);
    }
}
