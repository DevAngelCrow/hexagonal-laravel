<?php

namespace Src\modules\auth\application\useCases\user;

use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use DateTimeImmutable;
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

    public function run(int $id_people, string $user_name, string $password, int $id_status, DateTimeImmutable $last_access, bool $is_validated): void {

        $user = new User(
            new UserIdPeople($id_people),
            new UserName($user_name),
            new UserPassword($password),
            new UserIdStatus($id_status),
            new UserLastAccess($last_access),
            new UserIsValidated($is_validated)
        );

        $this->userRepository->create($user);
    }
}
