<?php
namespace Src\modules\catalogs\infrastructure\dtos\municipalityDtoHttpResponse;

use Src\modules\catalogs\domain\aggregate\municipality\MunicipalityWithDepartment;

class MunicipalityAggregateDtoHttp {
    public function __construct(public readonly MunicipalityWithDepartment $municipalityWithDepartment)
    {
        
    }
    public static function fromAggregate(MunicipalityWithDepartment $municipalityWithDepartment) : self{
        return new self($municipalityWithDepartment);
    }
    public function toArray() : array {
        $municipality = $this->municipalityWithDepartment->getMunicipality();
        $department = $this->municipalityWithDepartment->getDepartment();
        $municipalityMappedData = [
            "id" => $municipality->getId()->value(),
            "name" => $municipality->getName()->value(),
            "description" => $municipality->getDescription()->value(),
            "active" => $municipality->getActive()->value(),
        ];
        $departmentMappedData = [
            "id" => $department->getId()->value(),
            "name" => $department->getName()->value(),
            "description" => $department->getDescription()->value(),
        ];

        $municipalityMappedData["department"] = $departmentMappedData;
        
        return $municipalityMappedData;
    }
}