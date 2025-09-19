<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\profile\application\dtos\AddressDto;
use Src\modules\profile\application\useCases\address\AddressGetAll;
use Src\modules\profile\application\useCases\address\AddressCreate;
use Src\modules\profile\application\useCases\address\AddressGetAllWithDistrict;
use Src\modules\profile\application\useCases\address\AddressGetOneById;
use Src\modules\profile\application\useCases\address\AddressUpdate;
use Src\modules\profile\infrastructure\dtos\addressDtoHttpResponse\AddressAggregateDtoHttp;
use Src\modules\profile\infrastructure\dtos\addressDtoHttpResponse\AddressDtoHttp;
use Src\modules\profile\infrastructure\validators\address\CreateAddressRequest;
use Src\modules\profile\infrastructure\validators\address\GetAllAddressRequest;
use Src\modules\profile\infrastructure\validators\address\GetByIdAddressRequest;
use Src\modules\profile\infrastructure\validators\address\UpdateAddressRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class AddressController extends Controller
{
    use HttpResponses;
    protected AddressCreate $addressCreate;
    protected AddressGetAll $addressGetAll;
    protected AddressGetOneById $addressGetOneById;
    protected AddressUpdate $addressUpdate;
    protected AddressGetAllWithDistrict $addressGetAllWithDistrict;

    public function __construct(
        AddressCreate $address_create,
        AddressGetAll $address_get_all,
        AddressGetOneById $address_get_one_by_id,
        AddressUpdate $address_update,
        AddressGetAllWithDistrict $address_get_all_with_district
    ) {
        $this->addressCreate = $address_create;
        $this->addressGetAll = $address_get_all;
        $this->addressGetOneById = $address_get_one_by_id;
        $this->addressUpdate = $address_update;
        $this->addressGetAllWithDistrict = $address_get_all_with_district;
    }

    public function createAddress(CreateAddressRequest $request)
    {
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
            $request->active,
        );

        $this->addressCreate->run($addressDto);
        return $this->created([], "Direccion creada satisfactoriamente");
    }

    public function updateAddress(UpdateAddressRequest $request)
    {

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
            $request->active,
            (int) $request->id
        );
        $this->addressUpdate->run($addressDto);

        return $this->success([], "Dirección actualizada con éxito");
    }
    public function getAllAddress(GetAllAddressRequest $request)
    {


        $addressCollection = $this->addressGetAll->run($request->query('page'), $request->query('per_page'));

        $collections = array_map(fn($item) => AddressDtoHttp::fromEntity($item), $addressCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $addressCollection['pagination']);

        return $this->success($paginateData, "Success");
    }

    public function getOneByIdAddress(GetByIdAddressRequest $request)
    {


        $address = $this->addressGetOneById->run($request->id);


        return $this->success(AddressDtoHttp::fromEntity($address), "Success");
    }

    public function getAllAddressWithDistrict(GetAllAddressRequest $request)
    {
        $addressCollection = $this->addressGetAllWithDistrict->run($request->query('page'), $request->query('per_page'));
        
        $collections = array_map(fn($item) => AddressAggregateDtoHttp::fromAggregate($item)->toArray(), $addressCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $addressCollection['pagination']);

        return $this->success($paginateData, "Success");
    }
}
