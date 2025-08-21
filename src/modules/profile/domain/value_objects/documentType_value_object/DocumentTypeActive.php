<?php

namespace Src\modules\profile\domain\value_objects\documentType_value_object;

use Src\modules\profile\domain\exceptions\DocumentTypeException;

class DocumentTypeActive
{
    private bool $value;
    public function __construct(bool $value)
    {
        $this->value = $value;
    }

    public function value() : bool {
        return $this->value;
    }
}
