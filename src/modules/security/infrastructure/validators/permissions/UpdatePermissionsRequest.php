<?php
namespace Src\modules\security\infrastructure\validators\permissions;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdatePermissionsRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array {
        return [
            "id"=>"required|integer",
            "name" => "required|string",
            "id_category_permissions" => "required|integer",
            "description" => "string"
        ];
    }
}