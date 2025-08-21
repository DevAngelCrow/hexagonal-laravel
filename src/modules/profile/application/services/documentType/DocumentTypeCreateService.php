<?php

namespace Src\modules\profile\application\services\documentType;

use Src\modules\profile\application\dtos\DocumentTypeDto;
// use Src\modules\profile\application\useCases\address\AddressCreate;

class DocumentTypeCreateService
{
    private readonly DocumentType $addressCreate;

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
