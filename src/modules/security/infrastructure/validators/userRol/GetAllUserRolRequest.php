<?php

namespace Src\modules\security\infrastructure\validators\userRol;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllUserRolRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "page" => "integer",
            "per_page" => "integer"
        ];
    }
}