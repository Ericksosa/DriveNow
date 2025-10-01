<?php

namespace App\Exceptions;

use Exception;

class InsufficientCreditException extends Exception
{
    public function __construct($message = "Límite de crédito insuficiente.")
    {
        parent::__construct($message);
    }
}
