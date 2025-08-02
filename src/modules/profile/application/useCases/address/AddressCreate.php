<?php
namespace Src\modules\profile\application\useCases\address;

use Src\modules\profile\application\dtos\AddressDto;
use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\exceptions\AddressException;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressBlock;
use Src\modules\profile\domain\value_objects\address_value_object\AddressCurrent;
use Src\modules\profile\domain\value_objects\address_value_object\AddressHouseNumber;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdDistrict;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdPeople;
use Src\modules\profile\domain\value_objects\address_value_object\AddressNeighborhood;
use Src\modules\profile\domain\value_objects\address_value_object\AddressPathway;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreet;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreetNumber;

class AddressCreate {
    private AddressRepositoryInterface $repository;
    public function __construct(
         AddressRepositoryInterface $repository,
    )
    {
        $this->repository = $repository;
    }

    public function run(
    AddressDto $address
    ) : void {
        $address = new Address(
            new AddressStreet($address->street),
            new AddressStreetNumber($address->street_number),
            new AddressNeighborhood($address->neighborhood),
            new AddressIdDistrict($address->id_district),
            new AddressHouseNumber($address->house_number),
            new AddressBlock($address->block),
            new AddressPathway($address->pathway),
            new AddressCurrent($address->current),
            new AddressIdPeople($address->id_people),
        );
        $this->repository->create($address);

    

        // if(!$addressResult){
        //     throw new AddressException("Dirección no encontrada");
        // }

        

    }
}