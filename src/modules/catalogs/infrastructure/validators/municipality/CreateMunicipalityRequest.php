<?php
namespace Src\modules\catalogs\infrastructure\validators\municipality;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateMunicipalityRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"required|string",
            "id_department"=>"required|integer"
        ];
    }
}