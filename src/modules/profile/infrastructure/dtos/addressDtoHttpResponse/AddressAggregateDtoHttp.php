<?php
namespace Src\modules\profile\infrastructure\dtos\addressDtoHttpResponse;

use Src\modules\profile\domain\aggregate\address\AddressWithDistrict;

class AddressAggregateDtoHttp {
    public function __construct(public readonly AddressWithDistrict $addressDistrict)
    {
        
    }
    public static function fromAggregate(AddressWithDistrict $addressDistrict) : self{
        return new self($addressDistrict);
    }
    public function toArray() : array {
        $address = $this->addressDistrict->getAddress();
        $district = $this->addressDistrict->getDistrict();
        $addressMappedData = [
            "id" => $address->getId()->value(),
            "street" => $address->getStreet()->value(),
            "street_number" => $address->getStreetNumber()->value(),
            "neighborhood" => $address->getNeighborhood()->value(),
            "house_number" => $address->getHouseNumber()->value(),
            "block" => $address->getBlock()->value(),
            "pathway" => $address->getPathway()->value(),
            "current" => $address->getCurrent()->value(),
            "active" => $address->getActive()->value(),
        ];
        $districtMappedData = [
            "name" => $district->getName()->value(),
            "description" => $district->getDescription()->value(),
        ];

        $addressMappedData["district"] = $districtMappedData;
        
        return $addressMappedData;
    }
}