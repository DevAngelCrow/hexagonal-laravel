<?php
namespace Src\modules\auth\application\services\auth;

use Src\modules\auth\domain\ports\CredentialValidatorPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\modules\auth\domain\value_objects\user_value_objects\UserPassword;

class CredentialValildation {
    protected readonly CredentialValidatorPortInterface $credentialValidator;
    public function __construct(CredentialValidatorPortInterface $credential_validator) {
        $this->credentialValidator = $credential_validator;
        
    }

    public function run(string $user_name, string $password): bool {
        return $this->credentialValidator->validate(new UserName($user_name), new UserPassword($password));
    }
}