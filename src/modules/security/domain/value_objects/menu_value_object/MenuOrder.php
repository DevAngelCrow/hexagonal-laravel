<?php
namespace Src\modules\security\domain\value_objects\menu_value_object;
use DomainException;

class MenuOrder
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
            throw new DomainException("El campo orden es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new DomainException("El campo orden de menu debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}