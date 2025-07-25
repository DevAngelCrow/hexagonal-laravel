<?php

namespace Src\shared\domain;

enum HttpStatusCode: int
{
    // 2xx: Success
    case HTTP_OK = 200;
    case HTTP_CREATED = 201;
    case HTTP_ACCEPTED = 202;
    case HTTP_NO_CONTENT = 204;

    // 3xx: Redirection
    case HTTP_MOVED_PERMANENTLY = 301;
    case HTTP_FOUND = 302;
    case HTTP_NOT_MODIFIED = 304;

    // 4xx: Client Error
    case HTTP_BAD_REQUEST = 400;
    case HTTP_UNAUTHORIZED = 401;
    case HTTP_FORBIDDEN = 403;
    case HTTP_NOT_FOUND = 404;
    case HTTP_METHOD_NOT_ALLOWED = 405;
    case HTTP_CONFLICT = 409;
    case HTTP_UNPROCESSABLE_ENTITY = 422;
    case HTTP_TOO_MANY_REQUESTS = 429;

    // 5xx: Server Error
    case HTTP_INTERNAL_SERVER_ERROR = 500;
    case HTTP_NOT_IMPLEMENTED = 501;
    case HTTP_BAD_GATEWAY = 502;
    case HTTP_SERVICE_UNAVAILABLE = 503;
    case HTTP_GATEWAY_TIMEOUT = 504;
}
