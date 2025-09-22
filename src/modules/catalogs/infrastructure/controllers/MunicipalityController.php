<?php

namespace Src\modules\catalogs\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\application\dtos\MunicipalityDto;
use Src\modules\catalogs\application\usesCases\municipality\MunicipalityCreate;
use Src\modules\catalogs\application\usesCases\municipality\MunicipalityDelete;
use Src\modules\catalogs\application\usesCases\municipality\MunicipalityGetAll;
use Src\modules\catalogs\application\usesCases\municipality\MunicipalityGetAllWithDepartment;
use Src\modules\catalogs\application\usesCases\municipality\MunicipalityGetOneById;
use Src\modules\catalogs\application\usesCases\municipality\MunicipalityUpdate;
use Src\modules\catalogs\infrastructure\dtos\countryDtoHttpResponse\MunicipalityAggregateDtoHttp;
use Src\modules\catalogs\infrastructure\dtos\municipalityDtoHttpResponse\MunicipalityDtoHttp;
use Src\modules\catalogs\infrastructure\validators\municipality\CreateMunicipalityRequest;
use Src\modules\catalogs\infrastructure\validators\municipality\DeleteMunicipalityRequest;
use Src\modules\catalogs\infrastructure\validators\municipality\GetAllMunicipalitiesRequest;
use Src\modules\catalogs\infrastructure\validators\municipality\GetByIdMunicipalityRequest;
use Src\modules\catalogs\infrastructure\validators\municipality\UpdateMunicipalityRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class MunicipalityController extends Controller
{
    protected MunicipalityCreate $municipalityCreate;
    protected MunicipalityUpdate $municipalityUpdate;
    protected MunicipalityGetAll $municipalityGetAll;
    protected MunicipalityGetOneById $municipalityGetOneById;
    protected MunicipalityDelete $municipalityDelete;
    protected MunicipalityGetAllWithDepartment $municipalityGetAllWithDepartment;

    use HttpResponses;

    public function __construct(
        MunicipalityCreate $municipality_create,
        MunicipalityUpdate $municipality_update,
        MunicipalityGetAll $municipality_get_all,
        MunicipalityGetOneById $municipality_get_one_by_id,
        MunicipalityDelete $municipality_delete,
        MunicipalityGetAllWithDepartment $municipality_get_all_with_department
    ) {
        $this->municipalityCreate = $municipality_create;
        $this->municipalityUpdate = $municipality_update;
        $this->municipalityGetAll = $municipality_get_all;
        $this->municipalityGetOneById = $municipality_get_one_by_id;
        $this->municipalityDelete = $municipality_delete;
        $this->municipalityGetAllWithDepartment = $municipality_get_all_with_department;
    }

    public function createMunicipality(CreateMunicipalityRequest $request)
    {

        $municipality = new MunicipalityDto(
            $request->name,
            $request->description,
            (int) $request->id_department,
            $request->active
        );

        $this->municipalityCreate->run($municipality);

        return $this->created([], "Municipio creado exitosamente");
    }
    public function updateMunicipality(UpdateMunicipalityRequest $request)
    {
        $municipality = new MunicipalityDto(
            $request->name,
            $request->description,
            (int) $request->id_department,
            $request->active,
            (int) $request->id
        );

        $this->municipalityUpdate->run($municipality);

        return $this->success([], "Municipio actualizado exitosamente");
    }
    public function getOneByIdMunicipality(GetByIdMunicipalityRequest $request)
    {

        $municipality = $this->municipalityGetOneById->run($request->id);

        return $this->success(MunicipalityDtoHttp::fromEntity($municipality), "Success");
    }
    public function getAllMunicipality(GetAllMunicipalitiesRequest $request)
    {
        $municipalityCollection = $this->municipalityGetAll->run($request->query("page"), $request->query("per_page"));
        if($request->query("page") && $request->query("per_page")){
            $collections = array_map(fn($item) => MunicipalityDtoHttp::fromEntity($item), $municipalityCollection["data"]);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $municipalityCollection["pagination"]);
            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item) => MunicipalityDtoHttp::fromEntity($item), $municipalityCollection);
        return $this->success($data, "Success");
    }
    public function deletemunicipality(DeleteMunicipalityRequest $request)
    {
        $this->municipalityDelete->run($request->id);

        return $this->success([], "Registro de municipio borrado exitosamente");
    }
    public function getAllMunicipalityWithDepartment(GetAllMunicipalitiesRequest $request) {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $districtsCollection = $this->municipalityGetAllWithDepartment->run($page, $per_page);

        $collections = array_map(fn($item) => MunicipalityAggregateDtoHttp::fromAggregate($item)->toArray(), $districtsCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $districtsCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
}
