<?php
namespace Src\modules\security\infrastructure\validators\categoryPermissions;

use Src\shared\infrastructure\validators\BaseRequest;

class GetByIdCategoryPermissionsRequest extends BaseRequest {
    protected function prepareForValidation()
    {
        $this->merge(["id"=> $this->route("id")]);
    }
    public function rules() : array {
        return [
            "id"=>"required|integer"
        ];
    }
}