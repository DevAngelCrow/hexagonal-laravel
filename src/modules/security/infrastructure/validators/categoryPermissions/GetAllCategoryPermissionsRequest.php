<?php

namespace Src\modules\security\infrastructure\validators\categoryPermissions;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllCategoryPermissionsRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "page" => "integer",
            "per_page" => "integer",
            "filter_name" => "string"
        ];
    }
}
