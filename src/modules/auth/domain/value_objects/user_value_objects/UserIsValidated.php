<?php

namespace Src\modules\auth\domain\value_objects\user_value_objects;

//use Src\modules\profile\domain\exceptions\AddressException;

class UserIsValidated
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