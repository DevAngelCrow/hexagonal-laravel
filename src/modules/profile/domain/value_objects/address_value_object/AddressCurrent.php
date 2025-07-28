<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;

class AddressCurrent
{
    private bool $value;
    public function __construct(bool $value)
    {
        $this->value = $value;
        //$this->required();
    }

    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new AddressException("El campo numero de casa es obligatorio");
    //     }
    // }

    public function value() : bool {
        return $this->value;
    }
}