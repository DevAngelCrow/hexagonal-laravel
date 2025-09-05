<?php

namespace Src\modules\security\infrastructure\validators\userRol;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateUserRolRequest extends BaseRequest {
    public function rules() : array {
        return [
            "id_user" => "required|integer",
            "role_ids" => "required|array"
        ];
    }
}