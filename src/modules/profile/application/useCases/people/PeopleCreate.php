<?php

namespace Src\modules\profile\application\useCases\people;

use DateTimeImmutable;
use Src\modules\profile\application\dtos\PeopleDto;
use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;
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

    public function run(PeopleDto $peopleDto): ?People
    {
        $nationsId = array_map(fn($id_country) => new CountryId($id_country), $peopleDto->nationalities);
        
        $person = new People(
            new PeopleFirstName($peopleDto->first_name),
            new PeopleBirthDate($peopleDto->birthdate),
            new PeopleIdGender($peopleDto->id_gender),
            new PeopleEmail($peopleDto->email),
            new PeopleIdMaritalStatus($peopleDto->id_marital_status),
            new PeoplePhone($peopleDto->phone),
            new PeopleIdStatus($peopleDto->id_status),
            new PeopleMiddleName($peopleDto->middle_name),
            new PeopleLastName($peopleDto->last_name),
            new PeopleImgPath($peopleDto->img_path),
            null,
            $nationsId
        );

        

        return $this->peopleRepository->create($person);
    }
}
