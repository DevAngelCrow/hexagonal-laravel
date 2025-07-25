<?php

namespace Src\modules\profile\domain\value_objects\people_value_object;
use Src\modules\profile\domain\exceptions\PeopleException;

class PeopleId {

    private int $value;

    public function __construct(int $value)
    {
        $this->$value = $value;
        $this->required();
        $this->isNumber();
    }

    private function required()
    {
        if (!$this->value) {
            throw new PeopleException("El campo id es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || is_int($this->value)){
            throw new PeopleException("El campo id_people debe ser de tipo entero");
        }
    }
}