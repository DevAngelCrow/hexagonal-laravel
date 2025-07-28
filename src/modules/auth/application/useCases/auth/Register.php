<?php

namespace Src\modules\auth\application\useCases\auth;

use DateTimeImmutable;
use Src\modules\auth\application\useCases\user\UserCreate;
use Src\modules\auth\domain\repositories\user\UserRepositoryInterface;
use Src\modules\profile\application\services\people\PeopleCreateService;
use Src\shared\domain\repositories\UnitOfWorkTransactionDbInterface;

class Register
{
    private readonly UserCreate $userCreate;
    private readonly PeopleCreateService $peopleCreateService;
    private readonly UnitOfWorkTransactionDbInterface $transaction;

    public function __construct(UserCreate $user_create, PeopleCreateService $people_create_service, UnitOfWorkTransactionDbInterface $transaction_db)
    {
        $this->userCreate = $user_create;
        $this->peopleCreateService = $people_create_service;
        $this->transaction = $transaction_db;
    }

    public function run(string $first_name, string $middle_name, string $last_name, DateTimeImmutable $birthdate, int $id_gender,
      string $email, int $id_marital_status, string $img_path, string $phone, int $id_status, string $user_name, string $password,
      int $id_status_user, DateTimeImmutable $last_access, bool $is_validated) {
        $this->transaction->beginTransaction();

        $person = $this->peopleCreateService->createPersonForUser($first_name, $middle_name, $last_name, $birthdate, 
        $id_gender, $email, $id_marital_status, $img_path, $phone, $id_status);

        //dd($person);

        $this->userCreate->run($person->getId()->value(), $user_name, $password, $id_status_user, $last_access, $is_validated);

        $this->transaction->commit();
    }
}
