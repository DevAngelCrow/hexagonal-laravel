<?php
namespace Src\modules\auth\infrastructure\implementation\AuthPortImplementation;

use App\Models\MntUser as UserModel;
use Src\modules\auth\domain\ports\HasVerifiedEmailPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

class ImplHasVerifiedEmailPortInterface implements HasVerifiedEmailPortInterface {
    public function hasVerifiedEmail(UserName $user_name): bool
    {
        $userModel = UserModel::where("user_name", $user_name->value())->first();

        if(!$userModel->hasVerifiedEmail()) {
            return false;
        }

        return true;
    }
}