<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\address\AddressGetAll;
use Src\modules\profile\application\useCases\address\AddressCreate;
use Src\modules\profile\application\useCases\address\AddressGetOneById;
use Src\modules\profile\application\useCases\address\AddressUpdate;
use Src\modules\profile\infrastructure\dtos\addressDtoHttpResponse\AddressDtoHttp;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class AddressController extends Controller
{
    use HttpResponses;
    protected AddressCreate $addressCreate;
    protected AddressGetAll $addressGetAll;
    protected AddressGetOneById $addressGetOneById;
    protected AddressUpdate $addressUpdate;

    public function __construct(AddressCreate $address_create, AddressGetAll $address_get_all,
    AddressGetOneById $address_get_one_by_id, AddressUpdate $address_update)
    {
        $this->addressCreate = $address_create;
        $this->addressGetAll = $address_get_all;
        $this->addressGetOneById = $address_get_one_by_id;
        $this->addressUpdate = $address_update;
    }

    public function createAddress(Request $request)
    {
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
            return $this->created([], "Direccion creada satisfactoriamente");
        
    }

    public function updateAddress(Request $request){
            $id = (int) $request->id;
            $id_people = (int) $request->id_people;
            $street = $request->street;
            $street_number = $request->street_number;
            $neighborhood = $request->neighborhood;
            $id_district = (int) $request->id_district;
            $house_number = $request->house_number;
            $block = $request->block;
            $pathway = $request->pathway;
            $current = $request->current;
            

            $this->addressUpdate->run($id, $id_people, $street,  $street_number, $neighborhood, $id_district, $house_number, $block, $pathway, $current);

            return $this->success([], "Dirección actualizada con éxito");
    }
    public function getAllAddress(Request $request){

        
        $addressCollection = $this->addressGetAll->run($request->query('page'), $request->query('per_page'));
        
        $collectiones = array_map(fn($item) => AddressDtoHttp::fromEntity($item), $addressCollection["data"]);
        
        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collectiones, $addressCollection['pagination']);
        
        return $this->success($paginateData, "Success");
    }

    public function getOneByIdAddress(Request $request, int $id){
        
        $address = $this->addressGetOneById->run($id);


        return $this->success(AddressDtoHttp::fromEntity($address), "Success");
    }
}
