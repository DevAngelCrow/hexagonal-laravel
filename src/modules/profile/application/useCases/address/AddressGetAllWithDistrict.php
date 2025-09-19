<?php
namespace Src\modules\profile\application\useCases\address;

use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;

class AddressGetAllWithDistrict {
    private readonly AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $address_repository)
    {
        $this->addressRepository = $address_repository;
    }

    public function run(?int $page, ?int $per_page) : array {

        return $this->addressRepository->getAllWithDistrict($page, $per_page);

    }
}
