<?php

namespace Src\modules\catalogs\domain\value_objects\global_status_value_objects;

use Src\modules\catalogs\domain\exceptions\GlobalStatusException as ExceptionsGlobalStatusException;
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
            throw new ExceptionsGlobalStatusException("El campo name es obligatorio");
        }
    }


    public function value() : string {
        return $this->value;
    }
}
