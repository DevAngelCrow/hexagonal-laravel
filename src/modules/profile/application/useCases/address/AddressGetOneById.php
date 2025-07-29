<?php
namespace Src\modules\profile\application\useCases\address;

use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;

class AddressGetOneById {
    private readonly AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $address_repository)
    {
        $this->addressRepository = $address_repository;
    }

    public function run (int $id) : Address {

        return $this->addressRepository->getOneById(new AddressId($id));

    }
}