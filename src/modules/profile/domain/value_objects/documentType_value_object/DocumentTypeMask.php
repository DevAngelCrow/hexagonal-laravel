<?php

namespace Src\modules\profile\domain\value_objects\documentType_value_object;

use Src\modules\profile\domain\exceptions\DocumentTypeException;

class DocumentTypeMask
{
    private string $value;
    public function __construct(string $value)
    {
        $this->value = $value;
        //$this->required();
    }

    // private function required()
    // {
    //     if (!$this->value) {
    //         throw new DocumentTypeException("El campo mascara es obligatorio");
    //     }
    // }


    public function value() : string {
        return $this->value;
    }
}
