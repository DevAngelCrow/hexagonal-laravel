<?php

namespace Src\modules\profile\infrastructure\dtos\addressDtoHttpResponse;

use Src\modules\profile\domain\entities\address\Address;

class AddressDtoHttp
{
    public function __construct(
        public readonly int $id,
        public readonly string $street,
        public readonly string $street_number,
        public readonly string $neighborhood,
        public readonly int $id_district,
        public readonly string $house_number,
        public readonly string $block,
        public readonly string $pathway,
        public readonly bool $current,
        public readonly int $id_people
    ) {}

    public static function fromEntity(Address $address){
        //dd($address);
        return new self(
            $address->getId()->value(),
            $address->getStreet()->value(),
            $address->getStreetNumber()->value(),
            $address->getNeighborhood()->value(),
            $address->getIdDistrict()->value(),
            $address->getHouseNumber()->value(),
            $address->getBlock()->value(),
            $address->getPathway()->value(),
            $address->getCurrent()->value(),
            $address->getIdPeople()->value(),
        );
    }
}
