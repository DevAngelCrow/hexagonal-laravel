<?php
namespace Src\modules\profile\infrastructure\validators\people;

use Src\shared\infrastructure\validators\BaseRequest;

class DeletePeopleRequest extends BaseRequest {

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