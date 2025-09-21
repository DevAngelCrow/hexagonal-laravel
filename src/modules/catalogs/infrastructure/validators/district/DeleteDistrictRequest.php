<?php
namespace Src\modules\catalogs\infrastructure\validators\district;

use Src\shared\infrastructure\validators\BaseRequest;

class DeleteDistrictRequest extends BaseRequest {

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