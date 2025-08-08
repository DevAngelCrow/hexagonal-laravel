<?php
namespace Src\modules\profile\infrastructure\validators\district;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateDistrictRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"required|string",
            "id_country"=>"required|integer",
            "id" => "required|integer"
        ];
    }
}