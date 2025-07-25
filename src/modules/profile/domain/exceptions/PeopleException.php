<?php
namespace Src\modules\profile\domain\exceptions;
use Src\shared\domain\DomainException;

class PeopleException extends DomainException{
    public function __construct(string $message = "People internal exception", ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}