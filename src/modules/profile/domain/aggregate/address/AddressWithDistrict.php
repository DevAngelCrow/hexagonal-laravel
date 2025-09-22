<?php
namespace Src\modules\profile\domain\aggregate\address;

use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\profile\domain\entities\address\Address;

class AddressWithDistrict {
    private Address $address;
    private District $district;

    public function __construct(Address $address, District $district)
    {
        $this->address = $address;
        $this->district = $district;
    }

    public function getAddress() : Address {
        return $this->address;
    }
    public function getDistrict() : District {
        return $this->district;
    }
}