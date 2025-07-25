<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use ErrorException;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\address\AddressCreate;
use Src\modules\profile\domain\exceptions\AddressException;
use Src\shared\infrastructure\HttpResponses;

class AddressController extends Controller
{
    use HttpResponses;
    protected AddressCreate $addressCreate;

    public function __construct(AddressCreate $address_create)
    {
        $this->addressCreate = $address_create;
    }

    public function createAddress(Request $request)
    {
        try {
            $street = $request->street;
            $street_number = $request->street_number;
            $neighborhood = $request->neighborhood;
            $id_district = (int) $request->id_district;
            $house_number = $request->house_number;
            $block = $request->block;
            $pathway = $request->pathway;
            $current = $request->current;
            $id_people = (int) $request->id_people;
            $this->addressCreate->run($street, $street_number, $neighborhood, $id_district, $house_number, $block, $pathway, $current, $id_people);
            return response("creado exitosamente");
        }
        catch (ErrorException $e) {
            //dd($e);
            return $this->badRequest($e);
        }
    }
}
