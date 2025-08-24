<?php
namespace Src\modules\security\infrastructure\validators\categoryPermissions;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateCategoryPermissionsRequest extends BaseRequest {
    public function rules() : array {
        return [
            "name" => "required|string",
            "description" => "string"
        ];
    }
}