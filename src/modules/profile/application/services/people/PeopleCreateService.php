<?php
namespace Src\modules\profile\application\services\people;

use DateTimeImmutable;
use Src\modules\profile\application\useCases\people\PeopleCreate;

class PeopleCreateService{
    private readonly PeopleCreate $peopleCreate;

    public function __construct(PeopleCreate $people_create)
    {
        $this->peopleCreate = $people_create;
    }

    public function createPersonForUser(string $first_name, string $middle_name, string $last_name, DateTimeImmutable $birthdate, int $id_gender, string $email, int $id_marital_status, string $img_path, string $phone, int $id_status){
        $person = $this->peopleCreate->run($first_name, $middle_name, $last_name, $birthdate, $id_gender, $email, $id_marital_status, $img_path, $phone, $id_status);
        
        return $person;
    }
}