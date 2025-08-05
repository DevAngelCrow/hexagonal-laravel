<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\MunicipalityDto;
use Src\modules\profile\application\useCases\municipality\MunicipalityCreate;
use Src\modules\profile\application\useCases\municipality\MunicipalityDelete;
use Src\modules\profile\application\useCases\municipality\MunicipalityGetAll;
use Src\modules\profile\application\useCases\municipality\MunicipalityGetOneById;
use Src\modules\profile\application\useCases\municipality\MunicipalityUpdate;
use Src\modules\profile\infrastructure\dtos\municipalityDtoHttpResponse\MunicipalityDtoHttp;
use Src\modules\profile\infrastructure\validators\municipality\CreateMunicipalityRequest;
use Src\modules\profile\infrastructure\validators\municipality\DeleteMunicipalityRequest;
use Src\modules\profile\infrastructure\validators\municipality\GetAllMunicipalitiesRequest;
use Src\modules\profile\infrastructure\validators\municipality\GetByIdMunicipalityRequest;
use Src\modules\profile\infrastructure\validators\municipality\UpdateMunicipalityRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class MunicipalityController extends Controller
{
    protected MunicipalityCreate $municipalityCreate;
    protected MunicipalityUpdate $municipalityUpdate;
    protected MunicipalityGetAll $municipalityGetAll;
    protected MunicipalityGetOneById $municipalityGetOneById;
    protected MunicipalityDelete $municipalityDelete;

    use HttpResponses;

    public function __construct(
        MunicipalityCreate $municipality_create,
        MunicipalityUpdate $municipality_update,
        MunicipalityGetAll $municipality_get_all,
        MunicipalityGetOneById $municipality_get_one_by_id,
        MunicipalityDelete $municipality_delete,
    ) {
        $this->municipalityCreate = $municipality_create;
        $this->municipalityUpdate = $municipality_update;
        $this->municipalityGetAll = $municipality_get_all;
        $this->municipalityGetOneById = $municipality_get_one_by_id;
        $this->municipalityDelete = $municipality_delete;
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
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $municipalitiesCollection = $this->municipalityGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => MunicipalityDtoHttp::fromEntity($item), $municipalitiesCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $municipalitiesCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deletemunicipality(DeleteMunicipalityRequest $request)
    {
        $this->municipalityDelete->run($request->id);

        return $this->success([], "Registro de municipio borrado exitosamente");
    }
}
