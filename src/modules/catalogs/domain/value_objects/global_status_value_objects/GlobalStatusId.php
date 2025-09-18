<?php

namespace Src\modules\catalogs\domain\value_objects\global_status_value_objects;

use Src\modules\catalogs\domain\exceptions\GlobalStatusException;

class GlobalStatusId
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
            throw new GlobalStatusException("El campo id es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new GlobalStatusException("El campo id debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}
