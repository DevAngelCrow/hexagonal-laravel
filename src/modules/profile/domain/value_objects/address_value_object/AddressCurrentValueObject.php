<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;

class AddressCurrent
{
    private string $value;
    public function __construct(bool $value)
    {
        $this->$value = $value;
        //$this->required();
    }

    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new AddressException("El campo numero de casa es obligatorio");
    //     }
    // }
}