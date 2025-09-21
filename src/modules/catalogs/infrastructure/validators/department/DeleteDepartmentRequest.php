<?php
namespace Src\modules\catalogs\infrastructure\validators\department;

use Src\shared\infrastructure\validators\BaseRequest;

class DeleteDepartmentRequest extends BaseRequest {

    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id"=> "required|integer"
        ];
    }
}