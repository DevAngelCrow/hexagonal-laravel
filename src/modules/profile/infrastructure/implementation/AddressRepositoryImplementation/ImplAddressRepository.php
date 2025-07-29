<?php

namespace Src\modules\profile\infrastructure\implementation\AddressRepositoryImplementation;

use LogicException;
use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;
use App\Models\MntAddress as AddressModel;
use ErrorException;
use Exception;
use Src\modules\profile\domain\value_objects\address_value_object\AddressBlock;
use Src\modules\profile\domain\value_objects\address_value_object\AddressCurrent;
use Src\modules\profile\domain\value_objects\address_value_object\AddressHouseNumber;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdDistrict;
use Src\modules\profile\domain\value_objects\address_value_object\AddressIdPeople;
use Src\modules\profile\domain\value_objects\address_value_object\AddressNeighborhood;
use Src\modules\profile\domain\value_objects\address_value_object\AddressPathway;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreet;
use Src\modules\profile\domain\value_objects\address_value_object\AddressStreetNumber;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;


class ImplAddressRepository implements AddressRepositoryInterface
{
    private array $addressArray = [];
    public function create(Address $address): void
    {
        try {
            $addressModel = new AddressModel;
            $addressModel->id_people = $address->id_people->value();
            $addressModel->street = $address->street->value();
            $addressModel->street_number = $address->street_number->value();
            $addressModel->neighborhood = $address->neighborhood->value();
            $addressModel->id_district = $address->id_district->value();
            $addressModel->house_number = $address->house_number->value();
            $addressModel->block = $address->block->value();
            $addressModel->pathway = $address->pathway->value();
            $addressModel->current = $address->current->value();
            $addressModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Address $address): void
    {
        try {

            $addressModel = AddressModel::find($address->id->value());
            $addressModel->id_people = $address->id_people->value();
            $addressModel->street = $address->street->value();
            $addressModel->street_number = $address->street_number->value();
            $addressModel->neighborhood = $address->neighborhood->value();
            $addressModel->id_district = $address->id_district->value();
            $addressModel->house_number = $address->house_number->value();
            $addressModel->block = $address->block->value();
            $addressModel->pathway = $address->pathway->value();
            $addressModel->current = $address->current->value();

            $addressModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page = 1, ?int $per_page = 10): array
    {
        try {
            $addressModels =  AddressModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $addressModels->items());
            
            $this->addressArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $addressModels->currentPage(),
                    'last_page' => $addressModels->lastPage(),
                    'per_page' => $addressModels->perPage(),
                    'total' => $addressModels->total(),
                ]
            ];
            return $this->addressArray;
        } catch (Exception $e) {

            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(AddressId $id): ?Address
    {
        try{

            $addressDb = AddressModel::where("id", $id->value())->first();

            if(!$addressDb){
                throw new InfrastructureException("identificador de dirección no encontrada", Response::HTTP_NOT_FOUND);
            }

            $address = $this->mapToDomain($addressDb);

            return $address;

        }catch(Exception $e){
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(AddressId $id): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }

    private function mapToDomain(AddressModel $address): Address
    {
        return new Address(
            new AddressStreet($address->street),
            new AddressStreetNumber($address->street_number),
            new AddressNeighborhood($address->neighborhood),
            new AddressIdDistrict($address->id_district),
            new AddressHouseNumber($address->house_number),
            new AddressBlock($address->block),
            new AddressPathway($address->pathway),
            new AddressCurrent($address->current),
            new AddressIdPeople($address->id_people),
            new AddressId($address->id)
        );
    }
}
