<?php
namespace Src\modules\profile\application\useCases\people;

use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleEmail;

class PeopleGetOneByEmail{

    private readonly PeopleRepositoryInterface $peopleRepository;

    public function __construct(PeopleRepositoryInterface $people_repository)
    {
        $this->peopleRepository = $people_repository; 
    }

    public function run(string $email) : People {

        $emailPeople = new PeopleEmail($email);

        return $this->peopleRepository->getOneByEmail($emailPeople);

    }
}