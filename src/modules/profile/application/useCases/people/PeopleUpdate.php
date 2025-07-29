<?php

namespace Src\modules\profile\application\useCases\people;

use DateTimeImmutable;
use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleBirthDate;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleEmail;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleFirstName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleId;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdGender;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdMaritalStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleImgPath;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleLastName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleMiddleName;
use Src\modules\profile\domain\value_objects\people_value_object\PeoplePhone;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class PeopleUpdate
{
    private readonly PeopleRepositoryInterface $peopleRepository;

    public function __construct(PeopleRepositoryInterface $people_repository)
    {
        $this->peopleRepository = $people_repository;
    }

    public function run(int $id, string $first_name, string $middle_name, string $last_name, 
    DateTimeImmutable $birthdate, int $id_gender, string $email, int $id_marital_status, 
    string $img_path, string $phone, int $id_status) {
        $personDb = $this->peopleRepository->getOneById(new PeopleId($id));

        if(!$personDb){
            throw new ApplicationException("Identificador de persona no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }


        $person = new People(
            new PeopleFirstName($first_name),
            new PeopleBirthDate($birthdate),
            new PeopleIdGender($id_gender),
            new PeopleEmail($email),
            new PeopleIdMaritalStatus($id_marital_status),
            new PeoplePhone($phone),
            new PeopleIdStatus($id_status),
            new PeopleMiddleName($middle_name),
            new PeopleLastName($last_name),
            new PeopleImgPath($img_path),
        );

        $this->peopleRepository->update($person);
    }
}
