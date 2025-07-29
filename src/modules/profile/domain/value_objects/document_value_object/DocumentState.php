<?php

namespace Src\modules\profile\domain\value_objects\document_value_object;


class DocumentState
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