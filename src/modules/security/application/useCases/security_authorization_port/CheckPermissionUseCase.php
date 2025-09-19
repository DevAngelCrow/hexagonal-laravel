<?php
namespace Src\modules\security\application\useCases\security_authorization_port;

use Src\modules\security\domain\ports\SecurityAuthorizationPortInterface;

class CheckPermissionUseCase {
    protected readonly SecurityAuthorizationPortInterface $securityAuthorizationPort;

    public function __construct(SecurityAuthorizationPortInterface $security_authorization_port)
    {
        $this->securityAuthorizationPort = $security_authorization_port;
    }

    public function run(string $permission) : bool {
        return $this->securityAuthorizationPort->checkPermission($permission);
    }
}