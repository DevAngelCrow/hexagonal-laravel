<?php
namespace Src\modules\catalogs\domain\value_objects\department_value_object;

class DepartmentActive
{
    private ?bool $value;
    
    public function __construct(?bool $value)
    {
        $this->value = $value;
    }

    

    public function value() : ?bool {
        return $this->value;
    }
}
