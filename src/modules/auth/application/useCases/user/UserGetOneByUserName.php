<?php
namespace Src\modules\auth\application\useCases\user;

use Src\modules\auth\domain\entities\user\User;
use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;

class UserGetOneByUserName {
    private readonly UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $repository) {
        $this->userRepository = $repository;
    }

    public function run(string $user_name): User {
        return $this->userRepository->getByUserName(new UserName($user_name));
    }
}