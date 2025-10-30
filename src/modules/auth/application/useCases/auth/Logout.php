<?php
namespace Src\modules\auth\application\useCases\auth;

use Src\modules\auth\application\services\auth\CloseSession;

class Logout {
    protected readonly CloseSession $closeSession;

    public function __construct(CloseSession $close_session)
    {
        $this->closeSession = $close_session;
    }

    public function run(string $user_name) : bool {
        return $this->closeSession->run($user_name);
    }
}