<?php
namespace Src\modules\profile\application\services\people;

use Src\modules\profile\application\useCases\people\PeopleGetOneByEmail;

class PeopleGetOneByEmailService {
    private readonly PeopleGetOneByEmail $peopleGetOneByEmail;

    public function __construct(PeopleGetOneByEmail $people_get_one_by_email)
    {
        $this->peopleGetOneByEmail = $people_get_one_by_email;
    }

    public function findPersonbyEmailForUser(string $email){
        $person = $this->peopleGetOneByEmail->run($email);

        return $person;
    }
}