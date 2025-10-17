<?php

namespace Src\modules\security\domain\value_objects\menu_value_object;
class MenuRequiredAuth
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