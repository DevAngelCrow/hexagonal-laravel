<?php
namespace Src\modules\catalogs\infrastructure\validators\country;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateCountryRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "abbreviation"=>"required|string",
            "code"=>"required|string",
            "state"=>"boolean"
        ];
    }
}