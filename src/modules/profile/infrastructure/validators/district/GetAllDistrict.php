<?php
namespace Src\modules\profile\infrastructure\validators\district;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllDistrictRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}