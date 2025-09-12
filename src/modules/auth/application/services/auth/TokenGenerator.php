<?php
namespace Src\modules\auth\application\services\auth;

use Src\modules\auth\domain\ports\TokenGeneratorInterface;

class TokenGenerator {
    protected readonly TokenGeneratorInterface $tokenGenerator;
    public function __construct(TokenGeneratorInterface $token_generator) {
        $this->tokenGenerator = $token_generator;
        
    }

    public function run(mixed $userModel): string {
        return $this->tokenGenerator->generate($userModel);
    }
}