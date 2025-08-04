<?php
namespace Src\modules\profile\infrastructure\validators\municipality;

use Src\shared\infrastructure\validators\BaseRequest;

class DeleteMunicipalityRequest extends BaseRequest {

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