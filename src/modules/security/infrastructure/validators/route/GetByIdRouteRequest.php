<?php
namespace Src\modules\security\infrastructure\validators\route;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdRouteRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array {
        return [
            "id"=>"required|integer"
        ];
    }
}