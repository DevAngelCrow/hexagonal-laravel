<?php

namespace Src\modules\profile\domain\value_objects\country_value_object;

use Src\modules\profile\domain\exceptions\CountryException;

class CountryId
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
            throw new CountryException("El campo id es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new CountryException("El campo id country debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}