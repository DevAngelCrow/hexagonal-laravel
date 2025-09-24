<?php
namespace Src\modules\catalogs\infrastructure\validators\country;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateCountryRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id" => "required|integer",
            "name" => "required|string",
            "abbreviation" => "required|string",
            "code" => "required|string",
            "active" => "boolean"
        ];
    }
}