<?php

namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\RolDto;
use Src\modules\security\application\useCases\rol\RolCreate;
use Src\modules\security\application\useCases\rol\RolGetAll;
use Src\modules\security\application\useCases\rol\RolGetAllWithStatus;
use Src\modules\security\application\useCases\rol\RolGetOneById;
use Src\modules\security\application\useCases\rol\RolUpdate;
use Src\modules\security\infrastructure\dtos\RolDtoHttpResponse\RolAggregateDtoHttp;
use Src\modules\security\infrastructure\dtos\RolDtoHttpResponse\RolDtoHttp;
use Src\modules\security\infrastructure\validators\rol\CreateRolRequest;
use Src\modules\security\infrastructure\validators\rol\GetAllRolRequest;
use Src\modules\security\infrastructure\validators\rol\GetByIdRolRequest;
use Src\modules\security\infrastructure\validators\rol\UpdateRolRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class RolController extends Controller
{
    use HttpResponses;
    protected RolCreate $rolCreate;
    protected RolUpdate $rolUpdate;
    protected RolGetAll $rolGetAll;
    protected RolGetOneById $rolGetOneById;
    protected RolGetAllWithStatus $rolGetAllWithStatus;

    public function __construct(
        RolCreate $rol_create,
        RolUpdate $rol_update,
        RolGetAll $rol_get_all,
        RolGetOneById $rol_get_one_by_id,
        RolGetAllWithStatus $rol_get_all_with_status
    ) {
        $this->rolCreate = $rol_create;
        $this->rolUpdate = $rol_update;
        $this->rolGetAll = $rol_get_all;
        $this->rolGetOneById = $rol_get_one_by_id;
        $this->rolGetAllWithStatus = $rol_get_all_with_status;
    }
    public function createRol(CreateRolRequest $request)
    {

        $createRol = new RolDto(
            $request->name,
            $request->description,
            $request->id_status,
            $request->permissions_id
        );
        $this->rolCreate->run($createRol);

        return $this->created([], "Rol creado satisfactoriamente");
    }
    public function updateRol(UpdateRolRequest $request)
    {
        $rolUpdate = new RolDto(
            $request->name,
            $request->description,
            $request->id_status,
            $request->permissions_id,
            $request->id
        );

        $this->rolUpdate->run($rolUpdate);

        return $this->success([], "Registro de rol actualizado satisfactoriamente");
    }
    public function getOneByIdRol(GetByIdRolRequest $request)
    {
        $rol = $this->rolGetOneById->run($request->id);

        return $this->success(RolAggregateDtoHttp::fromAggregate($rol)->toArray(), "Success");
    }
    public function getAllRol(GetAllRolRequest $request)
    {
        $page = $request->page;
        $per_page = $request->per_page;
        $filter_name = $request->filter_name;

        $rolCollection = $this->rolGetAll->run($page, $per_page, $filter_name);
        if ($page && $per_page) {
            $collections = array_map(fn($item) => RolDtoHttp::fromEntity($item), $rolCollection["data"]);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $rolCollection["pagination"]);

            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item) => RolDtoHttp::fromEntity($item), $rolCollection);
        return $this->success($data, "Success");
    }
    public function getAllRolWithStatus(GetAllRolRequest $request)
    {
        $page = $request->page;
        $per_page = $request->per_page;
        $filter_name = $request->filter_name;

        $rolCollection = $this->rolGetAllWithStatus->run($page, $per_page, $filter_name);
        if ($page && $per_page) {
            $collections = array_map(fn($item) => RolAggregateDtoHttp::fromAggregate($item)->toArray(), $rolCollection["data"]);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $rolCollection["pagination"]);

            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item) => RolAggregateDtoHttp::fromAggregate($item)->toArray(), $rolCollection);
        return $this->success($data, "Success");
    }
}
