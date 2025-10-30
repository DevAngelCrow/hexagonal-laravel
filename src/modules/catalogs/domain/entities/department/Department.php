<?php

namespace Src\modules\catalogs\domain\entities\department;

use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentActive;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentId;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentName;

class Department
{
    private readonly DepartmentName $name;
    private readonly DepartmentDescription $description;
    private readonly DepartmentIdCountry $id_country;
    private readonly ?DepartmentActive $active;
    private readonly ?DepartmentId $id;

    public function __construct(
        DepartmentName $name,
        DepartmentDescription $description,
        DepartmentIdCountry $id_country,
        ?DepartmentActive $active = null,
        ?DepartmentId $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->id_country = $id_country;
        $this->active = $active;
        $this->id = $id;
    }

    public function getName(): DepartmentName
    {
        return $this->name;
    }

    public function getDescription(): DepartmentDescription
    {
        return $this->description;
    }

    public function getIdCountry(): DepartmentIdCountry
    {
        return $this->id_country;
    }
    public function getActive(): ?DepartmentActive
    {
        return $this->active;
    }
    public function getId(): ?DepartmentId
    {
        return $this->id;
    }
}
