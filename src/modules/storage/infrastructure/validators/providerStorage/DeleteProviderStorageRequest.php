<?php
namespace Src\modules\storage\infrastructure\validators\providerStorage;

use Src\shared\infrastructure\validators\BaseRequest;

class DeleteProviderStorageRequest extends BaseRequest {

    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id"=> "required|integer"
        ];
    }
}