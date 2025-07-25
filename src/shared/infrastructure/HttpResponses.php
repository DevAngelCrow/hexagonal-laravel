<?php
namespace Src\shared\infrastructure;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Src\shared\infrastructure\CustomErrorHttp;


trait HttpResponses {

    
    public function success(mixed $data = null, string $message = "Success", int $statusCode = Response::HTTP_OK) : JsonResponse{
        return response()->json([
            "message" => $message,
            "data" => $data
        ], $statusCode);
    }

    public function created(mixed $data = null, string $message = "Created"){
        return $this->success($data, $message, Response::HTTP_CREATED);
    }

    public function errorResponse(CustomErrorHttp $error) : JsonResponse{
         return response()->json($error->toArray(), $error->statusCode);
    }

    public function badRequest(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::badRequest($message, $details);
        return $this->errorResponse($error);
    }

    public function unauthorized(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::unauthorized($message, $details);
        return $this->errorResponse($error);
    }

    public function forbiden(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::forbidden($message, $details);
        return $this->errorResponse($error);
    }

    public function notFound(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::notFound($message, $details);
        return $this->errorResponse($error);
    }
    public function methodNotAllowed(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::methodNotAllowed($message, $details);
        return $this->errorResponse($error);
    }
    public function tooManyRequest(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::tooManyRequests($message, $details);
        return $this->errorResponse($error);
    }
    public function unprocesableEntity(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::unprocessableEntity($message, $details);
        return $this->errorResponse($error);
        
    }
    public function internalServerError(string $message, array $details = []) : JsonResponse {
        $error = CustomErrorHttp::internalServer($message, $details);
        return $this->errorResponse($error);
    }
}