<?php

namespace Src\modules\security\domain\value_objects\permissions_value_object;

class PermissionsActive
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