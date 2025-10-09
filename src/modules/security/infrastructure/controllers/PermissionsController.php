<?php

namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\PermissionsDto;
use Src\modules\security\application\useCases\permissions\PermissionsCreate;
use Src\modules\security\application\useCases\permissions\PermissionsGetAll;
use Src\modules\security\application\useCases\permissions\PermissionsGetOneById;
use Src\modules\security\application\useCases\permissions\PermissionsUpdate;
use Src\modules\security\infrastructure\dtos\permissionsDtoHttpResponse\PermissionsDtoHttp;
use Src\modules\security\infrastructure\validators\permissions\CreatePermissionsRequest;
use Src\modules\security\infrastructure\validators\permissions\GetAllPermissionsRequest;
use Src\modules\security\infrastructure\validators\permissions\GetByIdPermissionsRequest;
use Src\modules\security\infrastructure\validators\permissions\UpdatePermissionsRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class PermissionsController extends Controller
{
    use HttpResponses;

    protected PermissionsCreate $permissionsCreate;
    protected PermissionsUpdate $permissionsUpdate;
    protected PermissionsGetAll $permissionsGetAll;
    protected PermissionsGetOneById $permissionsGetOneById;

    public function __construct(PermissionsCreate $permissions_create, PermissionsUpdate $permissions_update, PermissionsGetAll $permissions_get_all, PermissionsGetOneById $permissions_get_one_by_id)
    {
        $this->permissionsCreate = $permissions_create;
        $this->permissionsUpdate = $permissions_update;
        $this->permissionsGetAll = $permissions_get_all;
        $this->permissionsGetOneById = $permissions_get_one_by_id;
    }

    public function createPermissions(CreatePermissionsRequest $request)
    {
        $createPermission = new PermissionsDto(
            $request->name,
            $request->id_category_permissions,
            $request->description,
            $request->active
        );

        $this->permissionsCreate->run($createPermission);

        return $this->created([], "Permiso creado satisfactoriamente");
    }
    public function updatePermissions(UpdatePermissionsRequest $request)
    {
        $updatePermission = new PermissionsDto(
            $request->name,
            $request->id_category_permissions,
            $request->description,
            $request->id
        );

        $this->permissionsUpdate->run($updatePermission);

        return $this->success([], "Registro de permiso actualizado satisfactoriamente");
    }
    public function getOneByIdPermissions(GetByIdPermissionsRequest $request)
    {
        $permission = $this->permissionsGetOneById->run($request->id);

        return $this->success(["data" => PermissionsDtoHttp::fromEntity($permission)]);
    }
    public function getAllPermissions(GetAllPermissionsRequest $request)
    {
        $permissionsCollection = $this->permissionsGetAll->run($request->query('page'), $request->query('per_page'));
        if ($request->query("page") && $request->query("per_page")) {
            $collections = array_map(fn($item) => PermissionsDtoHttp::fromEntity($item), $permissionsCollection['data']);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $permissionsCollection['pagination']);
            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item) => PermissionsDtoHttp::fromEntity($item), $permissionsCollection);
        return $this->success($data, "Success");
    }
}
