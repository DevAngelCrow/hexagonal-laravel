<?php
namespace Src\modules\security\infrastructure\validators\permissions;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllPermissionsRequest extends BaseRequest {
    public function rules(): array
    {
        return [
            "page" => "integer",
            "per_page" => "integer"
        ];
    }
}