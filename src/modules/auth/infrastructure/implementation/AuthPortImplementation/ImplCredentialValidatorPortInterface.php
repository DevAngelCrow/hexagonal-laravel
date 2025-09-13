<?php
namespace Src\modules\auth\infrastructure\implementation\AuthPortImplementation;

use Illuminate\Support\Facades\Auth;
use Src\modules\auth\domain\ports\CredentialValidatorPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\modules\auth\domain\value_objects\user_value_objects\UserPassword;

class ImplCredentialValidatorPortInterface implements CredentialValidatorPortInterface {
    public function validate(UserName $user_name, UserPassword $passsword): bool
    {
        $credentials = [
            "user_name" => $user_name->value(),
            "password" => $passsword->value()
        ];
        if(!Auth::attempt($credentials)){
            return false;
        }
        return true;
    }
}