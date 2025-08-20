<?php
namespace Src\modules\security\domain\value_objects\routes_value_object;

use DomainException;

class RoutesUri
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
            throw new DomainException("El campo uri es obligatorio");
        }
    }

    public function value() : string {
        return $this->value;
    }
}
