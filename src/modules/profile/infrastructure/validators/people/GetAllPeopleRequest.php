<?php
namespace Src\modules\profile\infrastructure\validators\people;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllPeopleRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}