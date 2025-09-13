<?php
namespace Src\modules\auth\domain\ports;

use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

interface TokenGeneratorPortInterface {
    public function generate(UserName $user_name) : array;
}