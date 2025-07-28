<?php
namespace Src\modules\auth\domain\value_objects\user_value_objects;

use DateTimeImmutable;
use Src\modules\auth\domain\exceptions\UserException;

class UserLastAccess {
    private DateTimeImmutable $value;
    public function __construct(DateTimeImmutable $value)
    {
        $this->value = $value;
        $this->required();
        $this->isDateTimeInmutable($value);
    }

    private function required(){
        if(!$this->value){
            throw new UserException("El campo de last_access es obligatorio");
        }
    }

    private function isDateTimeInmutable(mixed $value){
        if(!$value instanceof \DateTimeImmutable){
            return new UserException("Tipo invalido");
        }
    }


    public function value() : DateTimeImmutable {
        return $this->value;
    }
}