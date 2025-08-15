<?php

namespace Src\modules\profile\domain\value_objects\gender_value_object;

use Src\modules\profile\domain\exceptions\GenderException;
use Src\shared\domain\HttpStatusCode;

class GenderName{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    private function required()
    {
        if (!$this->value) {
            throw new GenderException("El campo name de género es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    private function validType()
    {
        if (!is_string($this->value)) {
            throw new GenderException("El campo name de género debe ser un string", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }
    
    public function value() : string {
        $this->required();
        $this->validType();
        return $this->value;
    }

}