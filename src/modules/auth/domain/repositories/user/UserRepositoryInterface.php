<?php

namespace Src\modules\auth\domain\repositories\user;

use Src\modules\auth\domain\entities\user\User;
use Src\modules\auth\domain\value_objects\user_value_objects\UserId;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

interface UserRepositoryInterface {
    public function create(User $user) : User;
    public function update(User $user) : void;
    /**
     * @return User[];
     */
    public function getAll() : array;
    public function getOneById(UserId $id): ?User;
    public function delete(UserId $id) : void;
    public function getByUserName(UserName $user_name): ?User;
}