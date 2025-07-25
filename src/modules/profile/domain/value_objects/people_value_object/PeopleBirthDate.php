<?php
namespace Src\modules\profile\domain\value_objects\people_value_object;

use DateTimeImmutable;
use Src\modules\profile\domain\exceptions\AddressException;

class PeopleBirthDate {
    private DateTimeImmutable $value;
    public function __construct(DateTimeImmutable $value)
    {
        $this->$value = $value;
        $this->required();
    }

    private function required(){
        if(!$this->value){
            throw new AddressException("El campo de fecha de nacimiento es obligatorio");
        }
    }

    public function value() : DateTimeImmutable {
        return $this->value;
    }
}