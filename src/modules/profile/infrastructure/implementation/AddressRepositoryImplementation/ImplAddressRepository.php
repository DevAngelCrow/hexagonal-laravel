<?php

namespace Src\modules\profile\infrastructure\implementation\AddressRepositoryImplementation;


use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;
use App\Models\MntAddress as AddressModel;
use ErrorException;
use Exception;
use Illuminate\Support\Facades\Auth;
use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictId;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictName;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictState;
use Src\modules\profile\domain\aggregate\address\AddressWithDistrict;
use Src\modules\profile\domain\value_objects\address_value_object\AddressActive;
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
            $addressModel->id_people = $address->getIdPeople()->value();
            $addressModel->street = $address->getStreet()->value();
            $addressModel->street_number = $address->getStreetNumber()->value();
            $addressModel->neighborhood = $address->getNeighborhood()->value();
            $addressModel->id_district = $address->getIdDistrict()->value();
            $addressModel->house_number = $address->getHouseNumber()->value();
            $addressModel->block = $address->getBlock()->value();
            $addressModel->pathway = $address->getPathway()->value();
            $addressModel->current = $address->getCurrent()->value();
            $addressModel->active = $address->getActive()->value();
            $addressModel->save();
        } catch (ErrorException $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Address $address): void
    {
        try {

            $addressModel = AddressModel::find($address->getId()->value());
            $addressModel->id_people = $address->getIdPeople()->value();
            $addressModel->street = $address->getStreet()->value();
            $addressModel->street_number = $address->getStreetNumber()->value();
            $addressModel->neighborhood = $address->getNeighborhood()->value();
            $addressModel->id_district = $address->getIdDistrict()->value();
            $addressModel->house_number = $address->getHouseNumber()->value();
            $addressModel->block = $address->getBlock()->value();
            $addressModel->pathway = $address->getPathway()->value();
            $addressModel->current = $address->getCurrent()->value();
            $addressModel->active = $address->getActive()->value();

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
        try {

            $addressDb = AddressModel::where("id", $id->value())->first();

            if (!$addressDb) {
                throw new InfrastructureException("identificador de dirección no encontrada", Response::HTTP_NOT_FOUND);
            }

            $address = $this->mapToDomain($addressDb);

            return $address;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(AddressId $id): void
    {
        try {
            $addressDb = AddressModel::find($id->value());

            $addressDb->current = false;
            $addressDb->save();
            $addressDb->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllWithDistrict(int $page, int $per_page): array
    {
        try {

            $user = Auth::user();

            if(!$user){
                throw new InfrastructureException('No autenticado', 401);
            }

            $addressModels =  AddressModel::where('id_people', (int)$user->id_people)->orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToAggregateDomain($item), $addressModels->items());

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
            new AddressActive($address->active),
            new AddressId($address->id)
        );
    }
    private function mapToAggregateDomain(AddressModel $address): AddressWithDistrict
    {
        $district = $this->mapToDomainDistrict($address);
        $addressMapped = new AddressWithDistrict(
            new Address(
                new AddressStreet($address->street),
                new AddressStreetNumber($address->street_number),
                new AddressNeighborhood($address->neighborhood),
                new AddressIdDistrict($address->id_district),
                new AddressHouseNumber($address->house_number),
                new AddressBlock($address->block),
                new AddressPathway($address->pathway),
                new AddressCurrent($address->current),
                new AddressIdPeople($address->id_people),
                new AddressActive($address->active),
                new AddressId($address->id)
            ),
            $district
        );

        return $addressMapped;
    }
    private function mapToDomainDistrict(AddressModel $address): District
    {
        $district = $address->district;
        
        $districtMapped = new District(
            new DistrictIdMunicipality($district->id_municipality),
            new DistrictName($district->name),
            new DistrictDescription($district->description),
            new DistrictState($district->active),
            new DistrictId($district->id)
        );
        return $districtMapped;
    }
}
