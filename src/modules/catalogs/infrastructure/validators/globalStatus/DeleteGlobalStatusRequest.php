<?php
namespace Src\modules\catalogs\infrastructure\validators\globalStatus;

use Src\shared\infrastructure\validators\BaseRequest;

class DeleteGlobalStatusRequest extends BaseRequest {

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
