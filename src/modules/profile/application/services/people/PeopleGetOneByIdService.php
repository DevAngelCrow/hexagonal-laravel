<?php
namespace Src\modules\profile\application\services\people;

use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\repositories\people\PeopleRepositoryInterface;

class PeopleGetOneByIdService {
    private readonly PeopleRepositoryInterface $peopleRepository;

    public function __construct(PeopleRepositoryInterface $people_repository)
    {   
        $this->peopleRepository = $people_repository;
    }

    // public function run() : People {
    //     $idPeople
        
    // }
}