<?php
namespace Src\modules\catalogs\infrastructure\validators\globalStatus;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdGlobalStatusRequest extends BaseRequest {

    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id"=> "required|integer"
        ];
    }
}
