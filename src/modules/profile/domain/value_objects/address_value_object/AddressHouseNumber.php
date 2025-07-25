<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;

class AddressHouseNumber
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
            throw new AddressException("El campo numero de casa es obligatorio");
        }
    }

    public function value() : string {
        return $this->value;
    }
}
