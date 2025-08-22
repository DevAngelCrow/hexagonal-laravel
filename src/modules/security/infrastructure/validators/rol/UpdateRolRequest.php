<?php
namespace Src\modules\security\infrastructure\validators\rol;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateRolRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array {
        return [
            "id"=>"required|integer",
            "name" => "required|string",
            "description" => "string",
            "id_status" => "required|integer"
        ];
    }
}