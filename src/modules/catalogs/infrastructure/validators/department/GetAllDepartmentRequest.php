<?php
namespace Src\modules\catalogs\infrastructure\validators\department;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllDepartmentRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}