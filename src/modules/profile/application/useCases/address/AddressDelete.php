<?php
namespace Src\modules\profile\application\useCases\address;

use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class AddressDelete {
    private readonly AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $address_repository)
    {
        $this->addressRepository = $address_repository;
    }

    public function run(int $id) : void {
        $address = $this->addressRepository->getOneById(new AddressId($id));

        if(!$address){
            throw new ApplicationException("Identificador de dirección no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->addressRepository->delete($address->getId());
    }
}