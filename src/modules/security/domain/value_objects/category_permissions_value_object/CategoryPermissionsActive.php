<?php

namespace Src\modules\security\domain\value_objects\category_permissions_value_object;
class CategoryPermissionsActive
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