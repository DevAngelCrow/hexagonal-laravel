<?php
namespace Src\modules\profile\infrastructure\validators\address;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdAddressRequest extends BaseRequest {

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