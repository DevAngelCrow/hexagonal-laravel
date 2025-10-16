<?php
namespace Src\modules\catalogs\infrastructure\validators\municipality;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllMunicipalitiesRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer",
            "filter_name" => "string"
        ];
    }
}