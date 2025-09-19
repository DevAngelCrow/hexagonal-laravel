<?php
namespace Src\modules\profile\infrastructure\dtos\municipalityDtoHttpResponse;

use Src\modules\profile\domain\aggregate\municipality\MunicipalityWithDepartment;

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
        ];
        $departmentMappedData = [
            "name" => $department->getName()->value(),
            "description" => $department->getDescription()->value(),
        ];

        $municipalityMappedData["department"] = $departmentMappedData;
        
        return $municipalityMappedData;
    }
}