<?php

namespace Src\modules\security\infraestructure\validators\userRol;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdUserRolRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }

    public function rules() : array {
        return [
            "id"=>"required|integer"
        ];
    }
}