<?php

namespace Src\modules\auth\application\useCases\user;

use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use Src\modules\auth\application\useCases\dtos\UserDto;
use Src\modules\auth\domain\entities\user\User;
use Src\modules\auth\domain\value_objects\user_value_objects\UserIdPeople;
use Src\modules\auth\domain\value_objects\user_value_objects\UserIdStatus;
use Src\modules\auth\domain\value_objects\user_value_objects\UserIsValidated;
use Src\modules\auth\domain\value_objects\user_value_objects\UserLastAccess;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\modules\auth\domain\value_objects\user_value_objects\UserPassword;

class UserCreate
{
    private readonly UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->userRepository = $repository;
    }

    public function run(UserDto $userDto): void {

        $user = new User(
            new UserIdPeople($userDto->id_people),
            new UserName($userDto->user_name),
            new UserPassword($userDto->password),
            new UserIdStatus($userDto->id_status),
            new UserLastAccess($userDto->last_access),
            new UserIsValidated($userDto->is_validated)
        );

        $this->userRepository->create($user);
    }
}
