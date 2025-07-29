<?php

namespace Src\modules\profile\application\services\address;

use Src\modules\profile\application\useCases\address\AddressCreate;

class AddressCreateService
{
    private readonly AddressCreate $addressCreate;

    public function __construct(AddressCreate $address_create)
    {
        $this->addressCreate = $address_create;
    }

    public function createAddressForUser(
        string $street,
        string $street_number,
        string $neighborhood,
        int $id_district,
        string $house_number,
        string $block,
        string $pathway,
        bool $current,
        int $id_people,
    ) {

        $address = $this->addressCreate->run(
            $street,
            $street_number,
            $neighborhood,
            $id_district,
            $house_number,
            $block,
            $pathway,
            $current,
            $id_people
        );

        return $address;
    }
}
