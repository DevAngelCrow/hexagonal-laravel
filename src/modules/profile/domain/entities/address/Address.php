<?php

namespace Src\modules\profile\domain\entities\address;

use Src\modules\profile\domain\value_objects\address_value_object\AddressBlock;
use Src\modules\profile\domain\value_objects\address_value_object\AddressHouseNumber;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdDistrict;
use Src\modules\profile\domain\value_objects\address_value_object\AddressNeighborhood;
use Src\modules\profile\domain\value_objects\address_value_object\AddressPathway;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreet;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreetNumber;
use Src\modules\profile\domain\value_objects\address_value_object\AddressCurrent;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdPeople;

class Address
{
    readonly ?AddressId $id;
    readonly AddressStreet $street;
    readonly AddressStreetNumber $street_number;
    readonly AddressNeighborhood $neighborhood;
    readonly AddressIdDistrict $id_district;
    readonly AddressHouseNumber $house_number;
    readonly AddressBlock $block;
    readonly AddressPathway $pathway;
    readonly AddressCurrent $current;
    readonly AddressIdPeople $id_people;

    public function __construct(
        //AddressStreet $street,
        AddressStreetNumber $street_number,
        AddressNeighborhood $neighborhood,
        AddressIdDistrict $id_district,
        AddressHouseNumber $house_number,
        AddressBlock $block,
        AddressPathway $pathway,
        AddressCurrent $current,
        AddressIdPeople $id_people,
        ?AddressId $id = null,
    ) {

        $this->id = $id;
        $this->street = $street;
        $this->street_number = $street_number;
        $this->neighborhood = $neighborhood;
        $this->id_district = $id_district;
        $this->house_number = $house_number;
        $this->block = $block;
        $this->pathway = $pathway;
        $this->current = $current;
        $this->id_people = $id_people;
    }
}
