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
            //dd($address);
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
        //dd($address);
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