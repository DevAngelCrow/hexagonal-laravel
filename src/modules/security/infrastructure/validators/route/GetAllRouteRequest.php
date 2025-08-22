<?php
namespace Src\modules\security\infrastructure\validators\route;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllRouteRequest extends BaseRequest {
    public function rules(): array
    {
        return [
            "page" => "integer",
            "per_page" => "integer"
        ];
    }
}