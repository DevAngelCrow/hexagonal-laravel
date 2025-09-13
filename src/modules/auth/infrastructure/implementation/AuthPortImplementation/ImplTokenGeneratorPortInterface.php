<?php
namespace Src\modules\auth\infrastructure\implementation\AuthPortImplementation;

use App\Models\MntUser as UserModel;;
use Src\modules\auth\domain\ports\TokenGeneratorPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

class ImplTokenGeneratorPortInterface implements TokenGeneratorPortInterface {
    public function generate(UserName $user_name): array
    {
        $userModel = UserModel::where("user_name", $user_name->value())->first();
        $token = $userModel->createToken("authToken")->accessToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $userModel
        ];
    }
}