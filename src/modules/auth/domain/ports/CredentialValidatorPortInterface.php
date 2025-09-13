<?php
namespace Src\modules\auth\domain\ports;

use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\modules\auth\domain\value_objects\user_value_objects\UserPassword;

interface CredentialValidatorPortInterface {
    public function validate(UserName $user_name, UserPassword $passsword) : bool;
}