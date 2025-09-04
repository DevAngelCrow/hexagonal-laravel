<?php
namespace Src\modules\security\domain\exceptions;
use Src\shared\domain\DomainException;
use Src\shared\domain\HttpStatusCode;

class PermissionsException extends DomainException{
    public function __construct(string $message = "Permissions internal exception",
    int $httpStatusCode = HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY->value,
    string $errorCode = DomainException::DEFAULT_ERROR_CODE, 
     ?\Throwable $previous = null)
    {
        parent::__construct($message, $errorCode, $httpStatusCode, $previous);
    }
}