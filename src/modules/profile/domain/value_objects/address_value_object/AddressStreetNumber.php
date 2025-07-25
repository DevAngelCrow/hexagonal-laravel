<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;


class AddressStreetNumber
{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
        // $this->required();
    }

    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new AddressException("El campo bloque es obligatorio");
    //     }
    // }

    public function value() : string {
        return $this->value;
    }
}
