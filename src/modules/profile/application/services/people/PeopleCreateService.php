<?php
namespace Src\modules\profile\application\services\people;

use DateTimeImmutable;
use Src\modules\profile\application\dtos\PeopleDto;
use Src\modules\profile\application\useCases\people\PeopleCreate;

class PeopleCreateService{
    private readonly PeopleCreate $peopleCreate;

    public function __construct(PeopleCreate $people_create)
    {
        $this->peopleCreate = $people_create;
    }

    public function createPersonForUser(PeopleDto $peopleDto){
        $person = $this->peopleCreate->run($peopleDto);
        
        return $person;
    }
}