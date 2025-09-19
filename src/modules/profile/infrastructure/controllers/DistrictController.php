<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\DistrictDto;
use Src\modules\profile\application\useCases\district\DistrictCreate;
use Src\modules\profile\application\useCases\district\DistrictDelete;
use Src\modules\profile\application\useCases\district\DistrictGetAll;
use Src\modules\profile\application\useCases\district\DistrictGetAllDistrictWithMunicipality;
use Src\modules\profile\application\useCases\district\DistrictGetOneById;
use Src\modules\profile\application\useCases\district\DistrictUpdate;
use Src\modules\profile\infrastructure\dtos\districtDtoHttpResponse\DistrictAggregateDtoHttp;
use Src\modules\profile\infrastructure\dtos\districtDtoHttpResponse\DistrictDtoHttp;
use Src\modules\profile\infrastructure\validators\district\CreateDistrictRequest;
use Src\modules\profile\infrastructure\validators\district\DeleteDistrictRequest;
use Src\modules\profile\infrastructure\validators\district\GetAllDistrictRequest;
use Src\modules\profile\infrastructure\validators\district\GetByIdDistrictRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class DistrictController extends Controller
{
    protected DistrictCreate $districtCreate;
    protected DistrictUpdate $districtUpdate;
    protected DistrictGetAll $districtGetAll;
    protected DistrictGetOneById $districtGetOneById;
    protected DistrictDelete $districtDelete;
    protected DistrictGetAllDistrictWithMunicipality $districtGetAllDistrictWithMunicipality;

    use HttpResponses;

    public function __construct(
        DistrictCreate $district_create,
        DistrictUpdate $district_update,
        DistrictGetAll $district_get_all,
        DistrictGetOneById $district_get_one_by_id,
        DistrictDelete $district_delete,
        DistrictGetAllDistrictWithMunicipality $district_get_all_district_with_municipality
    ) {
        $this->districtCreate = $district_create;
        $this->districtUpdate = $district_update;
        $this->districtGetAll = $district_get_all;
        $this->districtGetOneById = $district_get_one_by_id;
        $this->districtDelete = $district_delete;
        $this->districtGetAllDistrictWithMunicipality = $district_get_all_district_with_municipality;
    }

    public function createDistrict(CreateDistrictRequest $request)
    {
        $district = new DistrictDto(
            $request->name,
            $request->description,
            (int) $request->id_municipality,
            $request->active
        );

        $this->districtCreate->run($district);

        return $this->created([], "Distrito creado exitosamente");
    }
    public function updateDistrict(Request $request)
    {
        $district = new DistrictDto(
            (int) $request->id,
            $request->name,
            $request->description,
            (int) $request->id_municipality,
            $request->active
        );
      
        $this->districtUpdate->run($district);

        return $this->success([], "Distrito actualizado exitosamente");
    }
    public function getOneByIdDistrict(GetByIdDistrictRequest $request)
    {

        $district = $this->districtGetOneById->run($request->id);
        
        return $this->success(DistrictDtoHttp::fromEntity($district), "Success");
    }
    public function getAllDistrict(GetAllDistrictRequest $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $districtsCollection = $this->districtGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => districtDtoHttp::fromEntity($item), $districtsCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $districtsCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deleteDistrict(DeleteDistrictRequest $request)
    {
        $this->districtDelete->run($request->id);

        return $this->success([], "Registro de distrito borrado exitosamente");
    }
    public function getAllDistrictWithMunicipality(GetAllDistrictRequest $request) {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $districtsCollection = $this->districtGetAllDistrictWithMunicipality->run($page, $per_page);

        $collections = array_map(fn($item) => DistrictAggregateDtoHttp::fromAggregate($item)->toArray(), $districtsCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $districtsCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
}
