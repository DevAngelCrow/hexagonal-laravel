<?php

namespace Src\modules\catalogs\global_status\domain\value_objects;

use Src\modules\catalogs\global_status\domain\exceptions\GlobalStatusException;

class GlobalStatusTableHeader
{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
    }


    public function value() : string {
        return $this->value;
    }
}
