<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;

class AddressIdDepartment
{
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
            throw new AddressException("El campo id_department es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || is_int($this->value)){
            throw new AddressException("El campo debe ser de tipo entero");
        }
    }
}
