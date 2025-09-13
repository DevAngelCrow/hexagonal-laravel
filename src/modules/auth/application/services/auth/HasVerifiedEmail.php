<?php
namespace Src\modules\auth\application\services\auth;

use Src\modules\auth\domain\ports\HasVerifiedEmailPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

class HasVerifiedEmail {
    private readonly HasVerifiedEmailPortInterface $hasVerifiedEmailPort;

    public function __construct(HasVerifiedEmailPortInterface $has_verified_email_port) {
        $this->hasVerifiedEmailPort = $has_verified_email_port;
    }

    public function run(string $user_name): bool {
        return $this->hasVerifiedEmailPort->hasVerifiedEmail(new UserName($user_name));
    }
}