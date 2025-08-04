<?php
namespace Src\modules\profile\infrastructure\validators\documents;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllDocumentRequest extends BaseRequest {
    public function rules() : array{
        return [
            "page"=> "integer",
            "per_page" => "integer"
        ];
    }
}