<?php
namespace Src\modules\storage\infrastructure\validators\providerStorage;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateProviderStorageRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name" => "required|string",
            "description" => "string",
            "active" => "boolean",
        ];
    }
}