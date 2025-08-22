<?php

namespace Src\modules\profile\domain\value_objects\documentType_value_object;

use Src\modules\profile\domain\exceptions\DocumentTypeException;

class DocumentTypeId
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
            throw new DocumentTypeException("El campo id es obligatorio");
        }
    }

    private function isNumber(){
        if($this->value <= 0 || !is_int($this->value)){
            throw new DocumentTypeException("El campo id address debe ser de tipo entero");
        }
    }
    public function value() : int {
        return $this->value;
    }
}
