<?php
namespace Src\modules\security\infrastructure\validators\rol;

use Src\shared\infrastructure\validators\BaseRequest;

class CreateRolRequest extends BaseRequest {
    public function rules(): array
    {
        return [
            "name"=>"required|string",
            "description"=>"string",
            "id_status"=>"required|integer",
            "permissions_id"=>"array"
        ];
    }
}