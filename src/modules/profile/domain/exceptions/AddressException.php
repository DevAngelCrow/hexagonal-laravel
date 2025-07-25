<?php
namespace Src\modules\profile\domain\exceptions;

use Exception;

class AddressException extends Exception{
    public function __construct(string $message = "Address internal exception", ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}