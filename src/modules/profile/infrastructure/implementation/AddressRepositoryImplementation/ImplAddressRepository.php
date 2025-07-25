<?php

namespace Src\modules\profile\infrastructure\implementation\AddressRepositoryImplementation;

use LogicException;
use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\repositories\address\AddressRepositoryInterface;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;
use App\Models\MntAddress as AddressModel;
use ErrorException;

class ImplAddressRepository implements AddressRepositoryInterface {
    public function create(Address $address): void
    {
        try{
        
        $address = new AddressModel;
        $address->id_people = $address->id_people->value;
        $address->street = $address->street->value;
        $address->street_number = $address->street_number->value;
        $address->neighborhood = $address->neighborhood->value;
        $address->id_district = $address->id_district->value;
        $address->house_number = $address->house_number->value;
        $address->block = $address->block->value;
        $address->pathway = $address->pathway->value;
        $address->current = $address->current->value;

        $address->save();

        }catch(ErrorException $e){
            throw $e;
        }
        

    }
    public function update(Address $address): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }
    public function getAll(): array
    {
        throw new LogicException("El método aun no ha sido implementado");
    }
    public function getOneById(AddressId $id): ?Address
    {
        throw new LogicException("El método aun no ha sido implementado");
    }
    public function delete(AddressId $id): void
    {
        throw new LogicException("El método aun no ha sido implementado");
    }
}