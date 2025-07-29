<?php
namespace Src\shared\domain;
use Src\shared\domain\HttpStatusCode;

use Exception;

class ApplicationException extends Exception{
    public string $errorCode;
    protected int $httpStatusCode;

    const DEFAULT_ERROR_CODE = "APPLICATION_ERROR";
    const DEFAULT_HTTP_STATUS_CODE = HttpStatusCode::HTTP_UNPROCESSABLE_ENTITY->value;
    public function __construct(string $message = "Internal Application exception", string $errorCode = self::DEFAULT_ERROR_CODE,
    int $httpStatusCode = self::DEFAULT_HTTP_STATUS_CODE,
     ?\Throwable $previous = null)
    {
        parent::__construct($message, $previous);
        $this->errorCode = $errorCode;
        $this->httpStatusCode = $httpStatusCode;
    }

     public function getErrorCode(): string {
        return $this->errorCode;
    }

    public function getHttpStatusCode(): int {
        return $this->httpStatusCode;
    }
}