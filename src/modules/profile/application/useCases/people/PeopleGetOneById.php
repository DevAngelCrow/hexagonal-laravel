<?php
namespace Src\modules\profile\application\useCases\people;

use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleId;

class PeopleGetOneById{

    private readonly PeopleRepositoryInterface $peopleRepository;

    public function __construct(PeopleRepositoryInterface $people_repository)
    {
        $this->peopleRepository = $people_repository; 
    }

    public function run(int $idPeople) : People {

        $id_people = new PeopleId($idPeople);

        return $this->peopleRepository->getOneById($id_people);

    }
}