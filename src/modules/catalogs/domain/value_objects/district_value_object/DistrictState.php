<?php
namespace Src\modules\catalogs\domain\value_objects\district_value_object;


class DistrictState
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
