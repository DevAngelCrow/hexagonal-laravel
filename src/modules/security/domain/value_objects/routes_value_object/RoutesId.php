<?php
namespace Src\modules\security\domain\value_objects\routes_value_object;

use DomainException;

class RoutesId
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
            throw new DomainException("El campo id es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new DomainException("El campo id ruta debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}