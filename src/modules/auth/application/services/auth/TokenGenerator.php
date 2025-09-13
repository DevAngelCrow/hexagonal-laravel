<?php
namespace Src\modules\auth\application\services\auth;

use Src\modules\auth\domain\ports\TokenGeneratorPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

class TokenGenerator {
    protected readonly TokenGeneratorPortInterface $tokenGenerator;
    public function __construct(TokenGeneratorPortInterface $token_generator) {
        $this->tokenGenerator = $token_generator;
        
    }

    public function run(string $user_name): array {
        return $this->tokenGenerator->generate(new UserName($user_name));
    }
}