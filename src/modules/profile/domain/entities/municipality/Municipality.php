<?php

namespace Src\modules\profile\domain\entities\municipality;

use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityDescription;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityId;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityIdDepartment;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityName;

class Municipality
{
    private readonly MunicipalityName $name;
    private readonly MunicipalityDescription $description;
    private readonly MunicipalityIdDepartment $id_department;
    private readonly ?MunicipalityId $id;

    public function __construct(
        MunicipalityName $name,
        MunicipalityDescription $description,
        MunicipalityIdDepartment $id_department,
        ?MunicipalityId $id = null
    ) {
        $this->name = $name;
        $this->description = $description;
        $this->id_department = $id_department;
        $this->id = $id;
    }

    public function getName(): MunicipalityName
    {
        return $this->name;
    }

    public function getDescription(): MunicipalityDescription
    {
        return $this->description;
    }

    public function getIdDepartment(): MunicipalityIdDepartment
    {
        return $this->id_department;
    }
    public function getId(): ?MunicipalityId
    {
        return $this->id;
    }
}
