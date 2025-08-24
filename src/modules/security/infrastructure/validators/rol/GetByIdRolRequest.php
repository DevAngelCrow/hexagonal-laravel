<?php
namespace Src\modules\security\infrastructure\validators\rol;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdRolRequest extends BaseRequest {
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