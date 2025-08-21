<?php

namespace Src\modules\security\domain\value_objects\routes_value_object;

class RoutesActive
{
    private bool $value;
    public function __construct(bool $value)
    {
        $this->value = $value;
    
    }

    public function value() : bool {
        return $this->value;
    }
}