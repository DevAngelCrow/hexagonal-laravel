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
            $address->id->value(),
            $address->street->value(),
            $address->street_number->value(),
            $address->neighborhood->value(),
            $address->id_district->value(),
            $address->house_number->value(),
            $address->block->value(),
            $address->pathway->value(),
            $address->current->value(),
            $address->id_people->value(),
        );
    }
}
