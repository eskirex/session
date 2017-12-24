<?php

namespace Eskirex\Component\Session\Exceptions;

use Throwable;

class SessionRuntimeException extends \Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}