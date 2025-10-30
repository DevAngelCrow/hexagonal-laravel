<?php
namespace Src\modules\security\infrastructure\validators\permissions;

use Src\shared\infrastructure\validators\BaseRequest;

class CreatePermissionsRequest extends BaseRequest {
    public function rules() : array {
        return [
            "name" => "required|string",
            "id_category_permissions" => "required|integer",
            "description" => "string",
            "active"=> "bool"
        ];
    }
}