<?php

namespace Src\modules\profile\application\services\address;

use Src\modules\profile\application\dtos\AddressDto;
use Src\modules\profile\application\useCases\address\AddressCreate;

class AddressCreateService
{
    private readonly AddressCreate $addressCreate;

    public function __construct(AddressCreate $address_create)
    {
        $this->addressCreate = $address_create;
    }

    public function createAddressForUser(
        AddressDto $addressDto
    ) {

        $address = $this->addressCreate->run(
            $addressDto
        );

        return $address;
    }
}
