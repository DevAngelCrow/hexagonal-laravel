<?php
namespace Src\modules\profile\infrastructure\validators\country;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllCountriesRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}