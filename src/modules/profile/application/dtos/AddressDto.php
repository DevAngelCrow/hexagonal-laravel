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
            $address->street->value(),
            $address->street_number->value(),
            $address->neighborhood->value(),
            $address->id_district->value(),
            $address->house_number->value(),
            $address->block->value(),
            $address->pathway->value(),
            $address->current->value(),
            $address->id_people->value(),
            $address->id->value() ?: null
        );
    }
}