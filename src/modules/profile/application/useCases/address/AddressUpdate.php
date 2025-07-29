<?php
namespace Src\modules\profile\application\useCases\address;

use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressBlock;
use Src\modules\profile\domain\value_objects\address_value_object\AddressCurrent;
use Src\modules\profile\domain\value_objects\address_value_object\AddressHouseNumber;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdDistrict;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdPeople;
use Src\modules\profile\domain\value_objects\address_value_object\AddressNeighborhood;
use Src\modules\profile\domain\value_objects\address_value_object\AddressPathway;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreet;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreetNumber;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class AddressUpdate {
    private readonly AddressRepositoryInterface $addressRepository;

    public function __construct(AddressRepositoryInterface $address_repository)
    {
        $this->addressRepository = $address_repository;
    }

    public function run(int $id, int $id_people, string $street, string $street_number, 
    string $neighborhood, int $id_district, string $house_number, string $block, string $pathway,
    bool $current) : void {

        $idAddress = new AddressId($id);

        $addressDb =  $this->addressRepository->getOneById($idAddress);

        if(!$addressDb){
            throw new ApplicationException("Identificador de dirección no encontrado", HttpStatusCode::HTTP_NOT_FOUND->value);
        }

        $addressUpdate = new Address(
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

        $this->addressRepository->update($addressUpdate);

    }
}