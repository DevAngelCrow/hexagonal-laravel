<?php

namespace Src\shared\infrastructure;

use Symfony\Component\HttpFoundation\Response;

class CustomErrorHttp
{
    public int $statusCode;
    public string $message;
    public array $details;

    public function __construct(string $message, int $statusCode, array $details = [])
    {
        $this->message = $message;
        $this->statusCode = $statusCode;
        $this->details = $details;
    }

    public static function badRequest(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_BAD_REQUEST, $details);
    }

    public static function unauthorized(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_UNAUTHORIZED, $details);
    }

    public static function forbidden(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_UNAUTHORIZED, $details);
    }

    public static function notFound(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_NOT_FOUND, $details);
    }

    public static function methodNotAllowed(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_METHOD_NOT_ALLOWED, $details);
    }

    public static function unsupportedMediaType(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_UNSUPPORTED_MEDIA_TYPE, $details);
    }

    public static function tooManyRequests(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_TOO_MANY_REQUESTS, $details);
    }


    public static function unprocessableEntity(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_UNPROCESSABLE_ENTITY, $details);
    }

    public static function internalServer(string $message, array $details = []): self
    {
        return new self($message, Response::HTTP_INTERNAL_SERVER_ERROR, $details);
    }

    public function toArray(): array
    {
        return [
            'message' => $this->message,
            'code' => $this->statusCode, 
            'details' => $this->details, 
        ];
    }
    

    // public static function wrapperError(string $message, int $statusCode): self
    // {
    //     return new self($statusCode, $message);
    // }
}
