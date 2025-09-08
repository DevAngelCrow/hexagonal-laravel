<?php

namespace Src\modules\catalogs\global_status\domain\value_objects;

use Src\modules\catalogs\global_status\domain\exceptions\GlobalStatusException;

class GlobalStatusName
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
            throw new GlobalStatusException("El campo name es obligatorio");
        }
    }


    public function value() : string {
        return $this->value;
    }
}
