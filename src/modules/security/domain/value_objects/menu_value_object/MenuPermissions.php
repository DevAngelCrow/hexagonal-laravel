<?php

namespace Src\modules\security\domain\value_objects\menu_value_object;

use DomainException;

class MenuPermissions
{
    private array $value;
    public function __construct(array $value)
    {
        $this->value = $value;
        //$this->required();
    }

    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new DomainException("El campo rutas hijos es obligatorio");
    //     }
    // }

    public function value() : array {
        return $this->value;
    }
}
