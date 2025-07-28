<?php
namespace Src\modules\profile\domain\repositories\people;

use Src\modules\profile\domain\entities\people\People;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleEmail;
use Src\modules\profile\domain\value_objects\people_value_object\PeopleId;

interface PeopleRepositoryInterface {
    public function create(People $person) : ?People;
    public function update(People $person) : void;
    public function getAll() : array;
    public function getOneById(PeopleId $id) : ?People;
    public function delete(PeopleId $id) : void;
    public function getOneByEmail(PeopleEmail $email) : ?People;
}