<?php
namespace Src\modules\catalogs\infrastructure\validators\gender;
use Src\shared\infrastructure\validators\BaseRequest;

class CreateGenderRequest extends BaseRequest {
    public function rules() : array {
        return [
            "name" => "required|string|max:255",
        ];
    }
}