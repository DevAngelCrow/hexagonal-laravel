<?php
namespace Src\modules\catalogs\domain\aggregate\municipality;

use Src\modules\catalogs\domain\entities\department\Department;
use Src\modules\catalogs\domain\entities\municipality\Municipality;

class MunicipalityWithDepartment {
    private Municipality $municipality;
    private Department $deparment;

    public function __construct(Municipality $municipality, Department $department)
    {
        $this->municipality = $municipality;
        $this->deparment = $department;
    }

    public function getMunicipality() : Municipality {
        return $this->municipality;
    }
    public function getDepartment() : Department {
        return $this->deparment;
    }
}