<?php
namespace Src\modules\profile\infrastructure\validators\documentType;

use Src\shared\infrastructure\validators\BaseRequest;

class UpdateDocumentTypeRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array{
        return [
            "id" => "required|integer",
            "name" => "required",
            "description" => "string",
            "active" => "boolean",
            "mask"=>"string"
        ];
    }
}
