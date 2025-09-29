<?php
namespace Src\modules\auth\application\services\auth;

use Src\modules\auth\domain\ports\CloseSessionPortInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

class CloseSession {
    protected readonly CloseSessionPortInterface $closeSessionPort;
    public function __construct(CloseSessionPortInterface $close_session_port) {
        $this->closeSessionPort = $close_session_port;
        
    }

    public function run(string $user_name): bool {
       return $this->closeSessionPort->logout(new UserName($user_name));
    }
}