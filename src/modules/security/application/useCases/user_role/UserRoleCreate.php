<?php

namespace Src\modules\security\application\useCases\user_role;

use Src\modules\security\application\dtos\UserRoleDto;
use Src\modules\security\domain\entities\user_role\UserRole;
use Src\modules\security\domain\repositories\user_role\UserRoleRepositoryInterface;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleIdRol;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleIdUser;

class UserRoleCreate {
    private readonly UserRoleRepositoryInterface $userRoleRepository;

    public function __construct(UserRoleRepositoryInterface $user_role_repository)
    {
        $this->userRoleRepository = $user_role_repository;
    }

    public function run(UserRoleDto $userRoleDto) : void {

        $userRoleIdRol = new UserRoleIdRol($userRoleDto->role_ids); 

        $userRole = new UserRole(
            new UserRoleIdUser($userRoleDto->id_user),
            $userRoleIdRol,
        );

        $this->userRoleRepository->create($userRole);
        
    }
}