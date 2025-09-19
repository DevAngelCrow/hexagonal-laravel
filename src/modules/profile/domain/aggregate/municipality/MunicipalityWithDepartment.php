<?php
namespace Src\modules\profile\domain\aggregate\municipality;

use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\entities\municipality\Municipality;

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