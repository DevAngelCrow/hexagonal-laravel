<?php
namespace Src\modules\profile\infrastructure\validators\district;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateDistrictRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"required|string",
            "id_municipality"=>"required|integer",
            "state"=>"boolean"
        ];
    }
}