<?php
namespace Src\modules\profile\infrastructure\dtos\districtDtoHttpResponse;

use Src\modules\profile\domain\aggregate\district\DistrictWithMunicipality;

class DistrictAggregateDtoHttp {
    public function __construct(public readonly DistrictWithMunicipality $districtWithMunicipality)
    {
        
    }
    public static function fromAggregate(DistrictWithMunicipality $districtWithMunicipality) : self{
        return new self($districtWithMunicipality);
    }
    public function toArray() : array {
        $municipality = $this->districtWithMunicipality->getMunicipality();
        $district = $this->districtWithMunicipality->getDistrict();
        $districtMappedData = [
            "id" => $district->getId()->value(),
            "name" => $district->getName()->value(),
            "description" => $district->getDescription()->value(),
        ];
        $municipalityMappedData = [
            "name" => $municipality->getName()->value(),
            "description" => $municipality->getDescription()->value(),
        ];

        $districtMappedData["municipality"] = $municipalityMappedData;
        
        return $districtMappedData;
    }
}