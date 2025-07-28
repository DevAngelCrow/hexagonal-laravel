<?php
namespace Src\modules\profile\domain\value_objects\people_value_object;

use DateTimeImmutable;
use Src\modules\profile\domain\exceptions\PeopleException;

class PeopleBirthDate {
    private DateTimeImmutable $value;
    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
        $this->required();
        $this->isDateTimeInmutable($value);
    }

    private function required(){
        if(!$this->value){
            throw new PeopleException("El campo de fecha de nacimiento es obligatorio");
        }
    }

    private function isDateTimeInmutable(mixed $value){
        if(!$value instanceof \DateTimeImmutable){
            return new PeopleException("Tipo invalido");
        }
    }


    public function value() : DateTimeImmutable {
        return $this->value;
    }
}