<?php
namespace Src\modules\auth\application\useCases\auth;

use Deptrac\Deptrac\Supportive\Console\Application;
use Src\modules\auth\application\services\auth\CredentialValildation;
use Src\modules\auth\application\services\auth\TokenGenerator;
use Src\modules\auth\application\useCases\user\UserGetOneByUserName;
use Src\modules\auth\domain\entities\user\User;

class Login {
    protected readonly UserGetOneByUserName $userGetOneByUserName;
    protected readonly CredentialValildation $credentialValildation;
    protected readonly TokenGenerator $tokenGenerator;

    public function __construct(UserGetOneByUserName $user_get_one_by_user_name, CredentialValildation $credential_valildation, TokenGenerator $token_generator) {
        $this->userGetOneByUserName = $user_get_one_by_user_name;
        $this->credentialValildation = $credential_valildation;
        $this->tokenGenerator = $token_generator;
    }

    public function run(string $user_name, string $password): ?User {

        $is_valid = $this->credentialValildation->run($user_name, $password);

        if(!$is_valid) {
            throw new Application("Credenciales inválidas", 401);
        }

        $user = $this->userGetOneByUserName->run($user_name);

        return $user;
    }
}