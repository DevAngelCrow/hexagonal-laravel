<?php
namespace Src\modules\profile\infrastructure\validators\address;

use Src\modules\profile\infrastructure\validators\BaseRequest;

class CreateAddressRequest extends BaseRequest {
    public function rules() : array{
        return [
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