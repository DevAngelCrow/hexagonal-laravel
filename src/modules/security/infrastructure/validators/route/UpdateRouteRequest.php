<?php
namespace Src\modules\security\infrastructure\validators\route;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateRouteRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules(): array
    {
        return [
            "id"=>"required|integer",
            "id_parent"=>"integer",
            "name"=>"required|string",
            "description"=>"string",
            "icon"=>"string",
            "uri"=>"required|string",
            "active"=>"bool",
            "show"=>"bool",
            "order"=>"integer",
            "id_status"=>"required|integer"
        ];
    }
}