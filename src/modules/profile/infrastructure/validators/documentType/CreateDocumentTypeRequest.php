<?php
namespace Src\modules\profile\infrastructure\validators\documentType;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateDocumentTypeRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"string",
            "active"=>"boolean",
            "mask"=>"string"
        ];
    }
}
