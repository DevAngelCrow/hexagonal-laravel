<?php
namespace Src\shared\domain;
use Src\shared\domain\HttpStatusCode;

use Exception;

class DomainException extends Exception{
    public string $errorCode;
    protected int $httpStatusCode;

    const DEFAULT_ERROR_CODE = "DOMAIN_ERROR";
    const DEFAULT_HTTP_STATUS_CODE = HttpStatusCode::HTTP_BAD_REQUEST->value;
    public function __construct(string $message = "Internal Domain exception", string $errorCode = self::DEFAULT_ERROR_CODE,
    int $httpStatusCode = self::DEFAULT_HTTP_STATUS_CODE,
     ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
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