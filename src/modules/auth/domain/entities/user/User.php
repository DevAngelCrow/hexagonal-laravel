<?php

namespace Src\modules\auth\domain\entities\user;

use Src\modules\auth\domain\value_objects\user_value_objects\UserIdPeople;
use Src\modules\auth\domain\value_objects\user_value_objects\UserIdStatus;
use Src\modules\auth\domain\value_objects\user_value_objects\UserIsValidated;
use Src\modules\auth\domain\value_objects\user_value_objects\UserLastAccess;
use Src\modules\auth\domain\value_objects\user_value_objects\UserName;
use Src\modules\auth\domain\value_objects\user_value_objects\UserPassword;

class User
{

    private readonly UserIdPeople $id_people;
    private readonly UserName $user_name;
    private readonly UserPassword $password;
    private readonly UserIdStatus $id_status;
    private readonly UserLastAccess $last_access;
    private readonly UserIsValidated $is_validated;

    public function __construct(
        UserIdPeople $id_people,
        UserName $user_name,
        UserPassword $password,
        UserIdStatus $id_status,
        UserLastAccess $last_access,
        UserIsValidated $is_validated
    ) {
        $this->id_people = $id_people;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->id_status = $id_status;
        $this->last_access = $last_access;
        $this->is_validated = $is_validated;
    }
    public function getIdPeople(): UserIdPeople
    {
        return $this->id_people;
    }

    public function getUserName(): UserName
    {
        return $this->user_name;
    }

    public function getPassword(): UserPassword
    {
        return $this->password;
    }

    public function getIdStatus(): UserIdStatus
    {
        return $this->id_status;
    }

    public function getLastAccess(): UserLastAccess
    {
        return $this->last_access;
    }

    public function getIsValidated(): UserIsValidated
    {
        return $this->is_validated;
    }
}
