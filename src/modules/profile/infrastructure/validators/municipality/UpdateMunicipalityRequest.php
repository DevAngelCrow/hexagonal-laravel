<?php
namespace Src\modules\profile\infrastructure\validators\municipality;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateMunicipalityRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"required|string",
            "id_department"=>"required|integer",
            "id"=>"required|integer"
        ];
    }
}