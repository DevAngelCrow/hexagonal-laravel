<?php
namespace Src\modules\catalogs\domain\exceptions;

use Src\shared\domain\DomainException;
use Src\shared\domain\HttpStatusCode;

class GlobalStatusException extends DomainException
{

    public function __construct(
        string $message = "Global Status internal exception",
        int $httpStatusCode = HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY->value,
        string $errorCode = DomainException::DEFAULT_ERROR_CODE,
        ?\Throwable $previous = null
    ) {
        parent::__construct($message, $errorCode, $httpStatusCode, $previous);
    }
}
