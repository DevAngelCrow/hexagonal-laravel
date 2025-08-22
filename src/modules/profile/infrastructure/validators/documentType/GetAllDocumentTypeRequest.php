<?php
namespace Src\modules\profile\infrastructure\validators\documentType;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllDocumentTypeRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}
