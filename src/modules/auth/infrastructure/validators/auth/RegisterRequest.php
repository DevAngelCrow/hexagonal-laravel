<?php

namespace Src\modules\auth\infrastructure\validators\auth;

use Src\shared\infrastructure\validators\BaseRequest;

class RegisterRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "first_name" => "required|string",
            "middle_name" => "required|string",
            "last_name" => "required|string",
            "birthdate" => "required|date",
            "id_gender" => "required|integer",
            "email" => "required|email",
            "id_marital_status" => "required|integer",
            "img_path" => "required|string",
            "phone" => "required|string",
            "id_status" => "required|integer",
            "nationalities" => "required|array",

            //user data input
            "user_name" => "required|string",
            "password" => "required|string",
            "id_status_user" => "required|integer",
            "last_access" => "required|date",
            "is_validated" => "boolean",

            //address data input
            "street" => "required|string",
            "street_number" => "required|string",
            "neighborhood" => "required|string",
            "id_district" => "required|integer",
            "house_number" => "required|string",
            "block" => "required|string",
            "pathway" => "required|string",
            "current" => "boolean",

            //document data input
            "id_type_document" => "required|integer",
            "document_number" => "required|string",
            "description" => "required|string",
            "state" => "boolean"
        ];
    }
}
