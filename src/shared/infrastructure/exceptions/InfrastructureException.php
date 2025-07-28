<?php
namespace Src\shared\infrastructure\exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class InfrastructureException extends Exception{
    public string $errorCode;
    protected int $httpStatusCode;

    const DEFAULT_ERROR_CODE = "INFRASTRUCTURE_ERROR";
    const DEFAULT_HTTP_STATUS_CODE = Response::HTTP_BAD_REQUEST;
    public function __construct(string $message = "Infrastructure exception", string $errorCode = self::DEFAULT_ERROR_CODE,
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