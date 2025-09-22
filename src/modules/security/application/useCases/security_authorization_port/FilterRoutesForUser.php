<?php
namespace Src\modules\security\application\useCases\security_authorization_port;

use Src\modules\security\domain\ports\SecurityAuthorizationPortInterface;

class FilterRoutesForUser {
    protected readonly SecurityAuthorizationPortInterface $securityAuthorizationPortInterface;

    public function __construct(SecurityAuthorizationPortInterface $security_authorization_port_interface)
    {
        $this->securityAuthorizationPortInterface = $security_authorization_port_interface;
    }

    public function run() : array {
        return $this->securityAuthorizationPortInterface->filterRoutesForUser();
    }
}