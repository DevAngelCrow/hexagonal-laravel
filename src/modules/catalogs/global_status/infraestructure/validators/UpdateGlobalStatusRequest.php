<?php
namespace Src\modules\catalogs\global_status\infraestructure\validators;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateGlobalStatusRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id" => "required|integer",
            "name" => "required",
            "description" => "string",
            "table_header" => "string",
        ];
    }
}
