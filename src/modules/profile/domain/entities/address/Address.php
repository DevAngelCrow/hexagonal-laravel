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
    private readonly ?AddressId $id;
    private readonly AddressStreet $street;
    private readonly AddressStreetNumber $street_number;
    private readonly AddressNeighborhood $neighborhood;
    private readonly AddressIdDistrict $id_district;
    private readonly AddressHouseNumber $house_number;
    private readonly AddressBlock $block;
    private readonly AddressPathway $pathway;
    private readonly AddressCurrent $current;
    private readonly AddressIdPeople $id_people;

    public function __construct(
        AddressStreet $street,
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

    public function getId(): ?AddressId
    {
        return $this->id;
    }

    public function getStreet(): AddressStreet
    {
        return $this->street;
    }

    public function getStreetNumber(): AddressStreetNumber
    {
        return $this->street_number;
    }

    public function getNeighborhood(): AddressNeighborhood
    {
        return $this->neighborhood;
    }

    public function getIdDistrict(): AddressIdDistrict
    {
        return $this->id_district;
    }

    public function getHouseNumber(): AddressHouseNumber
    {
        return $this->house_number;
    }

    public function getBlock(): AddressBlock
    {
        return $this->block;
    }

    public function getPathway(): AddressPathway
    {
        return $this->pathway;
    }

    public function getCurrent(): AddressCurrent
    {
        return $this->current;
    }

    public function getIdPeople(): AddressIdPeople
    {
        return $this->id_people;
    }
}
