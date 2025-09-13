<?php
namespace Src\modules\auth\infrastructure\validators\auth;

use Src\shared\infrastructure\validators\BaseRequest;

class LoginRequest extends BaseRequest {
    public function rules(): array
    {
        return [
            "user_name" => "required|string",
            "password" => "required|string",
        ];
    }
}