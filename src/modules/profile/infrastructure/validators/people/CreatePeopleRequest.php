<?php
namespace Src\modules\profile\infrastructure\validators\people;

use Src\shared\infrastructure\validators\BaseRequest;

class CreatePeopleRequest extends BaseRequest {
    public function rules() : array{
        return [
            "first_name"=>"required|string",
            "middle_name"=>"required|string",
            "last_name"=>"required|string",
            "birthdate"=>"required|date",
            "id_gender"=>"required|integer",
            "email"=>"required|email",
            "id_marital_status"=> "required|integer",
            "img_path"=>"required|string",
            "phone"=>"required|string",
            "id_status"=>"required|integer",
        ];
    }
}