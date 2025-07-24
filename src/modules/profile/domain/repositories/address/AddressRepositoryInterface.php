<?php
namespace Src\modules\profile\domain\repositories\address;
use Src\modules\profile\domain\entities\address\Address;
use Src\modules\profile\domain\value_objects\address_value_object\AddressId;

interface AddressRepositoryInterface{
    public function create(Address $address) : void;
    public function update(Address $address) : void;
    /**
     * @return Address[];
     */
    public function getAll() : array;
    public function getOneById(AddressId $id): ?Address;
    public function delete(AddressId $id) : void;
}