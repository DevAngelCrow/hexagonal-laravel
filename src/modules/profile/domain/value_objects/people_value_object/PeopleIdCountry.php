<?php

namespace Src\modules\profile\domain\value_objects\people_value_object;
use Src\modules\profile\domain\exceptions\PeopleException;

class PeopleIdCountry {

    private int $value;

    public function __construct(int $value)
    {
        $this->value = $value;
        $this->required();
        $this->isNumber();
    }

    private function required()
    {
        if (!$this->value) {
            throw new PeopleException("El campo id_country es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new PeopleException("El campo id_country debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}