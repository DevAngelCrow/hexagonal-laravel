<?php

namespace Src\modules\auth\domain\value_objects\user_value_objects;

use Src\modules\auth\domain\exceptions\UserException;
use Src\shared\domain\HttpStatusCode;

class UserPassword
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
            throw new UserException("El campo password es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    public function value() : string {
        return $this->value;
    }
}
