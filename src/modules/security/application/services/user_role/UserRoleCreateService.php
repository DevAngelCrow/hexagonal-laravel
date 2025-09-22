<?php
namespace Src\modules\security\application\services\user_role;

use Src\modules\security\application\dtos\UserRoleDto;
use Src\modules\security\application\useCases\user_role\UserRoleCreate;

class UserRoleCreateService {
    protected readonly UserRoleCreate $userRoleCreate;

    public function __construct(UserRoleCreate $user_role_create)
    {
        $this->userRoleCreate = $user_role_create;
    }

    public function userRoleCreateForUser(UserRoleDto $userRoleDto) : void{
        $this->userRoleCreate->run($userRoleDto);
    }
}