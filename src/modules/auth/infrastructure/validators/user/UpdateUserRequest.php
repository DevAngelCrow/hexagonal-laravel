<?php
namespace Src\modules\auth\infrastructure\validators\user;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateUserRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id_people" => "required|integer",
            "user_name" => "required|string",
            "password" => "required|string",
            "id_status" => "required|integer",
            "last_access" => "required|date",
            "is_validate" => "boolean",
            "id"=>"required|integer"
        ];
    }
}