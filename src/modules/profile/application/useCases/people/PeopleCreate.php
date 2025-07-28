<?php

namespace Src\modules\profile\application\useCases\people;

use DateTimeImmutable;
use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleBirthDate;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleEmail;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleFirstName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdGender;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdMaritalStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleIdStatus;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleImgPath;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleLastName;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleMiddleName;
use Src\modules\profile\domain\value_objects\people_value_object\PeoplePhone;

class PeopleCreate
{
    private readonly PeopleRepositoryInterface $peopleRepository;
    public function __construct(PeopleRepositoryInterface $repository)
    {
        $this->peopleRepository = $repository;
    }

    public function run(string $first_name, string $middle_name, string $last_name, DateTimeImmutable $birthdate, int $id_gender, string $email, int $id_marital_status, string $img_path, string $phone, int $id_status): ?People
    {
        

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

        

        return $this->peopleRepository->create($person);
    }
}
