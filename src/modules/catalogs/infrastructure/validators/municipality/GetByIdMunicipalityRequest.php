<?php
namespace Src\modules\catalogs\infrastructure\validators\municipality;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdMunicipalityRequest extends BaseRequest {

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