<?php

namespace Src\modules\profile\domain\exceptions;

use Src\shared\domain\DomainException;
use Src\shared\domain\HttpStatusCode;

class AddressException extends DomainException
{
    
    const ID_DISTRICT_REQUIRED = "ADDRESS_ID_DISTRICT_REQUIRED";
    const ID_DISTRICT_INVALID_TYPE = "ADDRESS_ID_DISTRICT_INVALID_TYPE";
    const ID_DISTRICT_NOT_ACTIVE = "ADDRESS_DISTRICT_NOT_ACTIVE";
    public function __construct(string $message = "Address internal exception",
    int $httpStatusCode = HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY->value,
    string $errorCode = DomainException::DEFAULT_ERROR_CODE, 
     ?\Throwable $previous = null)
    {
        parent::__construct($message, $errorCode, $httpStatusCode, $previous);
    }
}
