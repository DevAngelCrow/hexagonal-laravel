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
            "street" => "required",
            "street_number" => "required",
            "neighborhood" => "required",
            "id_district" => "required|integer",
            "house_number" => "required",
            "block" => "required",
            "pathway" => "required",
            "id_people" => "required|integer"
        ];
    }
}