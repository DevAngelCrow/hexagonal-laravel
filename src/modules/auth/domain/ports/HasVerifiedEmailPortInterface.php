<?php
namespace Src\modules\auth\domain\ports;

use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

interface HasVerifiedEmailPortInterface {
    public function hasVerifiedEmail(UserName $userModel): bool;
}