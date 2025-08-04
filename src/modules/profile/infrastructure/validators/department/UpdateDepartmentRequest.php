<?php
namespace Src\modules\profile\infrastructure\validators\department;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateDepartmentRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"required|string",
            "id_country"=>"required|integer",
            "id" => "required|integer"
        ];
    }
}