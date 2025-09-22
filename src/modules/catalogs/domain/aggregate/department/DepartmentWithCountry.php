<?php
namespace Src\modules\catalogs\domain\aggregate\department;

use Src\modules\catalogs\domain\entities\country\Country;
use Src\modules\catalogs\domain\entities\department\Department;

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