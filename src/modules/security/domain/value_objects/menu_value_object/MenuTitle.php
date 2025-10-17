<?php

namespace Src\modules\security\domain\value_objects\menu_value_object;

use DomainException;

class MenuTitle
{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
        $this->required();
    }

    private function required()
    {
        if (!$this->value) {
            throw new DomainException("El campo titulo es obligatorio");
        }
    }

    public function value() : string {
        return $this->value;
    }
}
