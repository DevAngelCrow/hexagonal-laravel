<?php
namespace Src\modules\security\infrastructure\validators\permissions;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdPermissionsRequest extends BaseRequest {
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