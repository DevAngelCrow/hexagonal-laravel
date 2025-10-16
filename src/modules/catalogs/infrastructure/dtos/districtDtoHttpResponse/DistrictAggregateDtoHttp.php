<?php
namespace Src\modules\catalogs\infrastructure\dtos\districtDtoHttpResponse;

use Src\modules\catalogs\domain\aggregate\district\DistrictWithMunicipality;

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
            "active" => $district->getActive()->value(),
        ];
        $municipalityMappedData = [
            "id" => $municipality->getId()->value(),
            "name" => $municipality->getName()->value(),
            "description" => $municipality->getDescription()->value(),
            "active" => $municipality->getActive()->value()
        ];

        $districtMappedData["municipality"] = $municipalityMappedData;
        
        return $districtMappedData;
    }
}