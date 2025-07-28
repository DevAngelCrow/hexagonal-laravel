<?php

namespace Src\modules\auth\domain\value_objects\user_value_objects;

use Src\modules\auth\domain\exceptions\UserException;

class UserIdStatus
{
    private int $value;
    public function __construct(int $value)
    {
        $this->value = $value;
        $this->required();
        $this->isNumber();
    }

    private function required()
    {
        if (!$this->value) {
            throw new UserException("El campo id es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new UserException("El campo id_user_status debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}