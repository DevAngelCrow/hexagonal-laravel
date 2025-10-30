<?php
namespace Src\modules\security\infrastructure\validators\route;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateRouteRequest extends BaseRequest {
    public function rules(): array
    {
        return [
            "id_parent"=>"integer",
            "name"=>"required|string",
            "description"=>"string",
            "icon"=>"string",
            "uri"=>"required|string",
            "active"=>"bool",
            "show"=>"bool",
            "order"=>"integer",
            "title"=>"required|string",
            "permissions_id"=>"array"
        ];
    }
}