<?php
namespace Src\modules\catalogs\infrastructure\validators\globalStatus;

use Src\shared\infrastructure\validators\BaseRequest;

class GetAllGlobalStatusRequest extends BaseRequest
{
    public function rules(): array
    {
        return [
            "page" => "integer",
            "per_page" => "integer",
            "filter_name" => "string",
            "table_header" => "string"
        ];
    }
}
