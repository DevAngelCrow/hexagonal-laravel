<?php
namespace Src\modules\catalogs\global_status\infrastructure\validators;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllGlobalStatusRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}
