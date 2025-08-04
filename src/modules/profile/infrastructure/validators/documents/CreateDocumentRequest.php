<?php
namespace Src\modules\profile\infrastructure\validators\documents;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateDocumentRequest extends BaseRequest {
    public function rules() : array{
        return [
            "id_type_document"=>"required|integer",
            "id_people"=>"required|integer",
            "document_number"=>"required|string",
            "description"=>"required|string",
            "state"=>"boolean"
        ];
    }
}