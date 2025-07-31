<?php

namespace Src\modules\profile\domain\value_objects\municipality_value_object;

use Src\modules\profile\domain\exceptions\MunicipalityException;

class MunicipalityIdDepartment
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
            throw new MunicipalityException("El campo id department es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new MunicipalityException("El campo id department debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}