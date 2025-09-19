<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;

class AddressActive
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