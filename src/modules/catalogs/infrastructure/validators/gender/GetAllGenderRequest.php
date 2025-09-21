<?php

namespace Src\modules\catalogs\infrastructure\validators\gender;
use Src\shared\infrastructure\validators\BaseRequest;

class GetAllGenderRequest extends BaseRequest {
    public function rules() : array {
        return [
            "page" => "integer",
            "per_page" => "integer"
        ];
    }
}