<?php
namespace Src\modules\profile\application\useCases\address;

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
    string $street,
    string $street_number,
    string $neighborhood,
    int $id_district,
    string $house_number,
    string $block,
    string $pathway,
    bool $current,
    int $id_people,
    ) : void {
        $address = new Address(
            new AddressStreet($street),
            new AddressStreetNumber($street_number),
            new AddressNeighborhood($neighborhood),
            new AddressIdDistrict($id_district),
            new AddressHouseNumber($house_number),
            new AddressBlock($block),
            new AddressPathway($pathway),
            new AddressCurrent($current),
            new AddressIdPeople($id_people),
        );
        $this->repository->create($address);

    

        // if(!$addressResult){
        //     throw new AddressException("Dirección no encontrada");
        // }

        

    }
}