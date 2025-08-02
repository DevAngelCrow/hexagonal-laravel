<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\AddressDto;
use Src\modules\profile\application\useCases\address\AddressGetAll;
use Src\modules\profile\application\useCases\address\AddressCreate;
use Src\modules\profile\application\useCases\address\AddressGetOneById;
use Src\modules\profile\application\useCases\address\AddressUpdate;
use Src\modules\profile\infrastructure\dtos\addressDtoHttpResponse\AddressDtoHttp;
use Src\modules\profile\infrastructure\validators\address\CreateAddressRequest;
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

    public function createAddress(CreateAddressRequest $request)
    {
            //dd($request);
            $addressDto = new AddressDto(
                $request->street,
                $request->street_number,
                $request->neighborhood,
                (int) $request->id_district,
                $request->house_number,
                $request->block,
                $request->pathway,
                $request->current,
                (int) $request->id_people
            );

            $this->addressCreate->run($addressDto);
            return $this->created([], "Direccion creada satisfactoriamente");
        
    }

    public function updateAddress(Request $request){
            
            $addressDto = new AddressDto(
                $request->street,
                $request->street_number,
                $request->neighborhood,
                (int) $request->id_district,
                $request->house_number,
                $request->block,
                $request->pathway,
                $request->current,
                (int) $request->id_people,
                (int) $request->id
            );
            $this->addressUpdate->run($addressDto);

            return $this->success([], "Dirección actualizada con éxito");
    }
    public function getAllAddress(Request $request){

        
        $addressCollection = $this->addressGetAll->run($request->query('page'), $request->query('per_page'));
        
        $collections = array_map(fn($item) => AddressDtoHttp::fromEntity($item), $addressCollection["data"]);
        
        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $addressCollection['pagination']);
        
        return $this->success($paginateData, "Success");
    }

    public function getOneByIdAddress(Request $request, int $id){
        
        $address = $this->addressGetOneById->run($id);


        return $this->success(AddressDtoHttp::fromEntity($address), "Success");
    }
}
