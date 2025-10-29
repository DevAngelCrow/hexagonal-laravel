<?php
namespace Src\modules\security\infrastructure\validators\rol;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllRolRequest extends BaseRequest {
    public function rules(): array
    {
        return [
            "page" => "integer",
            "per_page" => "integer",
            "filter_name" => "string"
        ];
    }
}