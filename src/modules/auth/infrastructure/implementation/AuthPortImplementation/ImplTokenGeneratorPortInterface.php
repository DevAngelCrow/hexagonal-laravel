<?php
namespace Src\modules\auth\infrastructure\implementation\AuthPortImplementation;

use Src\modules\auth\domain\ports\TokenGeneratorInterface;

class ImplTokenGeneratorPortInterface implements TokenGeneratorInterface {
    public function generate(mixed $user): string
    {
        $token = $user->createToken("authToken")->accessToken;

        return $token;
    }
}