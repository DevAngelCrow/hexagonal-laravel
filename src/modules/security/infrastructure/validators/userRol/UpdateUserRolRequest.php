<?php

namespace Src\modules\security\infrastructure\validators\userRol;

class UpdateUserRolRequest extends CreateUserRolRequest {
    // protected function prepareForValidation()
    // {
    //     $this->merge(["id"=> $this->route("id")]);
    // }

    public function rules() : array {
        return [
            "id_user" => "required|integer",
            "role_ids" => "required|array"
        ];
    }
}