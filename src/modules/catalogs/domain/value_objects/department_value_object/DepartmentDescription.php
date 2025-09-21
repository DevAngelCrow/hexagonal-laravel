<?php
namespace Src\modules\catalogs\domain\value_objects\department_value_object;

use Src\modules\catalogs\domain\exceptions\DepartmentException;
use Src\shared\domain\HttpStatusCode;

class DepartmentDescription
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
            throw new DepartmentException("El campo descripción es obligatorio", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
    }

    public function value() : string {
        return $this->value;
    }
}
