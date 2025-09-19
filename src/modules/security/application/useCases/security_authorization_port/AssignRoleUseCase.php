<?php
namespace Src\modules\security\application\useCases\security_authorization_port;

use Src\modules\security\domain\ports\SecurityAuthorizationPortInterface;

class AssignRoleUseCase {
    protected readonly SecurityAuthorizationPortInterface $securityAuthorizationPort;

    public function __construct(SecurityAuthorizationPortInterface $security_authorization_port)
    {
        $this->securityAuthorizationPort = $security_authorization_port;
    }

    public function run(int $id_user, int $id_role) : void {
         //$this->securityAuthorizationPort->assignRole($id_user, $id_role);
    }
}