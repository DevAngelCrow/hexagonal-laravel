<?php
namespace Src\modules\storage\infrastructure\validators\providerStorage;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllProviderStorageRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}