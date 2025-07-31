<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\district\DistrictCreate;
use Src\modules\profile\application\useCases\district\DistrictDelete;
use Src\modules\profile\application\useCases\district\DistrictGetAll;
use Src\modules\profile\application\useCases\district\DistrictGetOneById;
use Src\modules\profile\application\useCases\district\DistrictUpdate;
use Src\modules\profile\infrastructure\dtos\districtDtoHttpResponse\DistrictDtoHttp;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class DistrictController extends Controller
{
    protected DistrictCreate $districtCreate;
    protected DistrictUpdate $districtUpdate;
    protected DistrictGetAll $districtGetAll;
    protected DistrictGetOneById $districtGetOneById;
    protected DistrictDelete $districtDelete;

    use HttpResponses;

    public function __construct(
        DistrictCreate $district_create,
        DistrictUpdate $district_update,
        DistrictGetAll $district_get_all,
        DistrictGetOneById $district_get_one_by_id,
        DistrictDelete $district_delete,
    ) {
        $this->districtCreate = $district_create;
        $this->districtUpdate = $district_update;
        $this->districtGetAll = $district_get_all;
        $this->districtGetOneById = $district_get_one_by_id;
        $this->districtDelete = $district_delete;
    }

    public function createDistrict(Request $request)
    {

        $name = $request->name;
        $description = $request->description;
        $id_municipality = (int) $request->id_municipality;
        $state = $request->state;

        $this->districtCreate->run($name, $description, $id_municipality, $state);

        return $this->created([], "Distrito creado exitosamente");
    }
    public function updateDistrict(Request $request)
    {
        $id = (int) $request->id;
        $name = $request->name;
        $description = $request->description;
        $id_municipality = (int) $request->id_municipality;
        $state = $request->state;

        $this->districtUpdate->run($id, $name, $description, $id_municipality, $state);

        return $this->success([], "Distrito actualizado exitosamente");
    }
    public function getOneByIdDistrict(Request $request, int $id)
    {

        $district = $this->districtGetOneById->run($id);
        
        return $this->success(DistrictDtoHttp::fromEntity($district), "Success");
    }
    public function getAllDistrict(Request $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $districtsCollection = $this->districtGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => districtDtoHttp::fromEntity($item), $districtsCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $districtsCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deleteDistrict(Request $request, int $id)
    {
        $this->districtDelete->run($id);

        return $this->success([], "Registro de distrito borrado exitosamente");
    }
}
