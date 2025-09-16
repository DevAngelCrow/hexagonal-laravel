<?php
namespace Src\modules\catalogs\infrastructure\validators\globalStatus;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateGlobalStatusRequest extends BaseRequest {
    public function rules() : array{
        return [
            "name"=>"required|string",
            "description"=>"string",
            "table_header"=>"string",
            "state"=>"boolean",
        ];
    }
}
