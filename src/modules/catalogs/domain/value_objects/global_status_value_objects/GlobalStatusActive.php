<?php

namespace Src\modules\catalogs\domain\value_objects\global_status_value_objects;

class GlobalStatusActive
{
    private ?bool $value;
    public function __construct(?bool $value)
    {
        $this->value = $value;
    
    }

    public function value() : ?bool {
        return $this->value;
    }
}