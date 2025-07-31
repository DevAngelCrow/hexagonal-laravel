<?php
namespace Src\modules\profile\domain\exceptions;

use Src\shared\domain\DomainException;
use Src\shared\domain\HttpStatusCode;

class DistrictException extends DomainException
{
    public function __construct(string $message = "District internal exception",
    int $httpStatusCode = HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY->value,
    string $errorCode = DomainException::DEFAULT_ERROR_CODE, 
     ?\Throwable $previous = null)
    {
        parent::__construct($message, $errorCode, $httpStatusCode, $previous);
    }
}