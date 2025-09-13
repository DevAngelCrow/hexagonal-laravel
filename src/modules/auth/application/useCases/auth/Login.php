<?php

namespace Src\modules\auth\application\useCases\auth;

use Deptrac\Deptrac\Supportive\Console\Application;
use Src\modules\auth\application\services\auth\CredentialValildation;
use Src\modules\auth\application\services\auth\HasVerifiedEmail;
use Src\modules\auth\application\services\auth\TokenGenerator;
use Src\modules\auth\application\useCases\user\UserGetOneByUserName;
use Src\modules\auth\domain\ports\TokenGeneratorPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\shared\application\exceptions\ApplicationException;

class Login
{
    protected readonly UserGetOneByUserName $userGetOneByUserName;
    protected readonly CredentialValildation $credentialValildation;
    protected readonly TokenGenerator $tokenGenerator;
    protected readonly HasVerifiedEmail $hasVerifiedEmail;

    public function __construct(UserGetOneByUserName $user_get_one_by_user_name, CredentialValildation $credential_valildation, TokenGenerator $token_generator, HasVerifiedEmail $has_verified_email)
    {
        $this->userGetOneByUserName = $user_get_one_by_user_name;
        $this->credentialValildation = $credential_valildation;
        $this->tokenGenerator = $token_generator;
        $this->hasVerifiedEmail = $has_verified_email;
    }

    public function run(string $user_name, string $password): array
    {

        $is_valid = $this->credentialValildation->run($user_name, $password);

        if (!$is_valid) {
            throw new ApplicationException("Credenciales inválidas", 401);
        }

        $is_verified = $this->hasVerifiedEmail->run($user_name);

        if (!$is_verified) {
            throw new ApplicationException("Por favor verifica tu correo antes de iniciar sesión", 403);
        }

       return $this->tokenGenerator->run($user_name);

        

    }
}
