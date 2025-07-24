<?php
namespace Src\modules\profile\domain\exceptions;

use Exception;

class PeopleException extends Exception{
    public function __construct(string $message = "People internal exception", ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}