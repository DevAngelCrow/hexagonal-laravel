<?php

namespace Src\modules\security\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\security\application\dtos\CategoryPermissionsDto;
use Src\modules\security\application\useCases\category_permissions\CategoryPermissionsCreate;
use Src\modules\security\application\useCases\category_permissions\CategoryPermissionsGetAll;
use Src\modules\security\application\useCases\category_permissions\CategoryPermissionsGetOneById;
use Src\modules\security\application\useCases\category_permissions\CategoryPermissionsUpdate;
use Src\modules\security\infrastructure\validators\categoryPermissions\CreateCategoryPermissionsRequest;
use Src\modules\security\infrastructure\validators\categoryPermissions\GetAllCategoryPermissionsRequest;
use Src\modules\security\infrastructure\validators\categoryPermissions\GetByIdCategoryPermissionsRequest;
use Src\modules\security\infrastructure\validators\categoryPermissions\UpdateCategoryPermissionsRequest;
use Src\shared\infrastructure\HttpResponses;

class CategoryPermissionsController extends Controller
{
    use HttpResponses;
    protected CategoryPermissionsCreate $categoryPermissionsCreate;
    protected CategoryPermissionsUpdate $categoryPermissionsUpdate;
    protected CategoryPermissionsGetAll $categoryPermissionsGetAll;
    protected CategoryPermissionsGetOneById $categoryPermissionsGetOneById;

    public function __construct(
        CategoryPermissionsCreate $category_permissions_create,
        CategoryPermissionsUpdate $category_permissions_update,
        CategoryPermissionsGetAll $category_permissions_get_all,
        CategoryPermissionsGetOneById $category_permissions_get_one_by_id,
    ) {
        $this->categoryPermissionsCreate = $category_permissions_create;
        $this->categoryPermissionsUpdate = $category_permissions_update;
        $this->categoryPermissionsGetAll = $category_permissions_get_all;
        $this->categoryPermissionsGetOneById = $category_permissions_get_one_by_id;
    }

    public function createCategoryPermission(CreateCategoryPermissionsRequest $request)
    {
        $categoryPermission = new CategoryPermissionsDto(
            $request->name,
            $request->description
        );

        $this->categoryPermissionsCreate->run($categoryPermission);

        return $this->created([], "Category de permiso creado satisfactoriamente");
    }
    public function updateCategoryPermissions(UpdateCategoryPermissionsRequest $request) {
        $categoryPermissionUpdate = new CategoryPermissionsDto(
            $request->name,
            $request->description,
            $request->id
        );

        $this->categoryPermissionsUpdate->run($categoryPermissionUpdate);

        return $this->success([], "Registro de categoria de permiso actualizado con éxito");
    }
    public function getOneByIdCategoryPermissions(GetByIdCategoryPermissionsRequest $request) {
        $categoryPermission = $this->categoryPermissionsGetOneById->run($request->id);

        //return $this->success(["data" => CategoryPermissionsDtoH])
    }
    public function getAllCategoryPermissions(GetAllCategoryPermissionsRequest $request) {}
}
