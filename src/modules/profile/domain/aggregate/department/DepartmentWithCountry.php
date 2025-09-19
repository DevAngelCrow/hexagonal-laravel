<?php
namespace Src\modules\profile\domain\aggregate\department;

use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\entities\district\District;
use Src\modules\profile\domain\entities\municipality\Municipality;

class DepartmentWithCountry {
    private Country $country;
    private Department $department;

    public function __construct(Country $country, Department $department)
    {
        $this->country = $country;
        $this->department = $department;
    }

    public function getCountry() : Country {
        return $this->country;
    }
    public function getDepartment() : Department {
        return $this->department;
    }
}