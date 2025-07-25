<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;
use Src\shared\domain\HttpStatusCode;

class AddressIdPeople
{
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
            throw new AddressException("El campo id_people es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new AddressException("El campo id_people debe ser de tipo entero", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }
    public function value() : int {
        return $this->value;
    }
}