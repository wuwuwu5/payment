<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class WebValidatorException extends Exception
{
    public $data;

    public function __construct($message = "", $data = [], $code = 0, Throwable $previous = null)
    {
        $this->data = $data;
        parent::__construct($message, $code, $previous);
    }

    public function getData()
    {
        return $this->data;
    }
}
