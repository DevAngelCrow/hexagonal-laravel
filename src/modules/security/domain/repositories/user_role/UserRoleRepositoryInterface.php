<?php

namespace Src\modules\security\domain\repositories\user_role;

use App\Models\UserRol;
use Src\modules\security\domain\entities\user_role\UserRole;
use Src\modules\security\domain\value_objects\user_role_value_object\UserRoleId;

interface UserRoleRepositoryInterface {
    /**
     * @return UserRole[];
     */
    public function create(UserRole $user_role) : void;
    public function updateOrCreate(UserRole $user_role) : void;
    /**
     * @return UserRole[];
     */

    public function getAll(int $page, int $per_page) : array;
    public function getOneById(UserRoleId $id): ?UserRole;
    
}