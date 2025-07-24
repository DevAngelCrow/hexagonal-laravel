<?php
namespace Src\modules\profile\infrastructure\controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\address\AddressCreate;

class AddressController extends Controller {

    protected AddressCreate $addressCreate;

    public function __construct(AddressCreate $address_create)
    {
        $this->addressCreate = $address_create;
    }

    public function createAddress(Request $request) {

        $street = $request->street;
        $street_number = $request->street_number;
        $neighborhood = $request->neighborhood;
        $id_district = $request->id_district;
        $house_number = $request->house_number;
        $block = $request->block;
        $pathway = $request->pathway;
        $current = $request->current;
        $id_people = $request->id_people;

        $this->addressCreate->run($street, $street_number, $neighborhood, $id_district, $house_number, $block, $pathway, $current, $id_people);

    }
}