<?php
namespace Src\modules\profile\domain\exceptions;

use Src\shared\domain\DomainException;
use Src\shared\domain\HttpStatusCode;

class GenderException extends DomainException
{
    const NAME_REQUIRED = "GENDER_NAME_REQUIRED";
    const NAME_INVALID_TYPE = "GENDER_NAME_INVALID_TYPE";
    const NAME_NOT_ACTIVE = "GENDER_NAME_NOT_ACTIVE";
    public function __construct(string $message ="genders internal exception",
    int $httpStatusCode = HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY->value,
    string $errorCode = DomainException::DEFAULT_ERROR_CODE,
        ?\Throwable $previous = null)
        {
            parent::__construct($message, $errorCode, $httpStatusCode, $previous);
        }
}