<?php

namespace Src\modules\profile\domain\value_objects\address_value_object;

use Src\modules\profile\domain\exceptions\AddressException;
use Src\shared\domain\HttpStatusCode;

class AddressBlock
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
            throw new AddressException("El campo bloque es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    public function value() : string {
        return $this->value;
    }
}
