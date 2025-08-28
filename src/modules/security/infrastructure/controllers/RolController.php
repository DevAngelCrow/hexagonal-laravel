<?php
namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\RolDto;
use Src\modules\security\application\useCases\rol\RolCreate;
use Src\modules\security\application\useCases\rol\RolGetAll;
use Src\modules\security\application\useCases\rol\RolGetOneById;
use Src\modules\security\application\useCases\rol\RolUpdate;
use Src\modules\security\infrastructure\dtos\RolDtoHttpResponse\RolDtoHttp;
use Src\modules\security\infrastructure\validators\rol\CreateRolRequest;
use Src\modules\security\infrastructure\validators\rol\GetAllRolRequest;
use Src\modules\security\infrastructure\validators\rol\GetByIdRolRequest;
use Src\modules\security\infrastructure\validators\rol\UpdateRolRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class RolController extends Controller {
    use HttpResponses;
    protected RolCreate $rolCreate;
    protected RolUpdate $rolUpdate;
    protected RolGetAll $rolGetAll;
    protected RolGetOneById $rolGetOneById;

    public function __construct(RolCreate $rol_create, RolUpdate $rol_update,
    RolGetAll $rol_get_all, RolGetOneById $rol_get_one_by_id)
    {
        $this->rolCreate = $rol_create;
        $this->rolUpdate = $rol_update;
        $this->rolGetAll = $rol_get_all;
        $this->rolGetOneById = $rol_get_one_by_id;
    }
    public function createRol(CreateRolRequest $request){
        $createRol = new RolDto(
            $request->name,
            $request->description,
            $request->id_status,
        );

        $this->rolCreate->run($createRol);

        return $this->created([], "Rol creado satisfactoriamente");
    }
    public function updateRol(UpdateRolRequest $request){
        $rolUpdate = new RolDto(
            $request->name,
            $request->description,
            $request->id_status,
            $request->id
        );

        $this->rolUpdate->run($rolUpdate);

        return $this->success([], "Registro de rol actualizado satisfactoriamente");
    }
    public function getOneByIdRol(GetByIdRolRequest $request){
        $rol = $this->rolGetOneById->run($request->id);

        return $this->success(["data"=> RolDtoHttp::fromEntity($rol)]);
    }
    public function getAllRol(GetAllRolRequest $request){
        $rolCollection = $this->rolGetAll->run($request->query('page'), $request->query('per_page'));
        $collections = array_map(fn($item)=> RolDtoHttp::fromEntity($item), $rolCollection["data"]);
        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $rolCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
}