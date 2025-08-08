<?php
namespace Src\modules\profile\application\dtos;

use Src\modules\profile\domain\entities\address\Address;

class AddressDto {

    public function __construct(
        public readonly string $street,
        public readonly string $street_number,
        public readonly string $neighborhood,
        public readonly int $id_district,
        public readonly string $house_number,
        public readonly string $block,
        public readonly string $pathway,
        public readonly bool $current,
        public readonly int $id_people,
        public readonly ?int $id = null){     
    }

    public static function fromEntity(Address $address): self {
        return new self(
            $address->getStreet()->value(),
            $address->getStreetNumber()->value(),
            $address->getNeighborhood()->value(),
            $address->getIdDistrict()->value(),
            $address->getHouseNumber()->value(),
            $address->getBlock()->value(),
            $address->getPathway()->value(),
            $address->getCurrent()->value(),
            $address->getIdPeople()->value(),
            $address->getId()->value() ?: null
        );
    }
}