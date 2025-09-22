<?php
namespace Src\modules\catalogs\infrastructure\validators\department;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateDepartmentRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"required|string",
            "id_country"=>"required|integer",
        ];
    }
}