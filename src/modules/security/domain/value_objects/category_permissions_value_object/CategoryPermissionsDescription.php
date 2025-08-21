<?php

namespace Src\modules\security\domain\value_objects\category_permissions_value_object;

use DomainException;

class CategoryPermissionsDescription
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
            throw new DomainException("El campo descripción es obligatorio");
        }
    }

    public function value() : string {
        return $this->value;
    }
}
