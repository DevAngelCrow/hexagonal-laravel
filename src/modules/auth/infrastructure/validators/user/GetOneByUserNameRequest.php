<?php
namespace Src\modules\auth\infrastructure\validators\user;

use Src\shared\infrastructure\validators\BaseRequest;

class GetOneByUserNameRequest extends BaseRequest{
    protected function prepareForValidation()
    {
        $this->merge(["user_name"=> $this->route("user_name")]);
    }
    public function rules() : array{
        return [
            "user_name"=> "required|string"
        ];
    }
}