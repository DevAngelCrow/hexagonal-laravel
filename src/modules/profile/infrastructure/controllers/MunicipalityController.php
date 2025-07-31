<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\municipality\MunicipalityCreate;
use Src\modules\profile\application\useCases\municipality\MunicipalityDelete;
use Src\modules\profile\application\useCases\municipality\MunicipalityGetAll;
use Src\modules\profile\application\useCases\municipality\MunicipalityGetOneById;
use Src\modules\profile\application\useCases\municipality\MunicipalityUpdate;
use Src\modules\profile\infrastructure\dtos\municipalityDtoHttpResponse\MunicipalityDtoHttp;
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

    public function createMunicipality(Request $request)
    {

        $name = $request->name;
        $description = $request->description;
        $id_department = (int) $request->id_department;

        $this->municipalityCreate->run($name, $description, $id_department);

        return $this->created([], "Municipio creado exitosamente");
    }
    public function updateMunicipality(Request $request)
    {
        $id = (int) $request->id;
        $name = $request->name;
        $description = $request->description;
        $id_department = (int) $request->id_department;

        $this->municipalityUpdate->run($id, $name, $description, $id_department);

        return $this->success([], "Municipio actualizado exitosamente");
    }
    public function getOneByIdMunicipality(Request $request, int $id)
    {

        $municipality = $this->municipalityGetOneById->run($id);
        
        return $this->success(MunicipalityDtoHttp::fromEntity($municipality), "Success");
    }
    public function getAllMunicipality(Request $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $municipalitiesCollection = $this->municipalityGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => MunicipalityDtoHttp::fromEntity($item), $municipalitiesCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $municipalitiesCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deletemunicipality(Request $request, int $id)
    {
        $this->municipalityDelete->run($id);

        return $this->success([], "Registro de municipio borrado exitosamente");
    }
}
