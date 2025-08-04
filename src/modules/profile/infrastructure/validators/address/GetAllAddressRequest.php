<?php
namespace Src\modules\profile\infrastructure\validators\address;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllAddressRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}