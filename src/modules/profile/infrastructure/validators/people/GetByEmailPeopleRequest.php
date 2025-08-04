<?php
namespace Src\modules\profile\infrastructure\validators\people;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByEmailPeopleRequest extends BaseRequest {

    protected function prepareForValidation()
    {
        $this->merge(["email"=> $this->route("email")]);
    }
    public function rules() : array{
        return [
            "email"=> "required|string"
        ];
    }
}