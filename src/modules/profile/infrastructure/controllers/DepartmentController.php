<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\useCases\department\DepartmentCreate;
use Src\modules\profile\application\useCases\department\DepartmentDelete;
use Src\modules\profile\application\useCases\department\DepartmentGetAll;
use Src\modules\profile\application\useCases\department\DepartmentGetOneById;
use Src\modules\profile\application\useCases\department\DepartmentUpdate;
use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\infrastructure\dtos\departmentDtoHttpResponse\DepartmentDtoHttp;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class DepartmentController extends Controller
{
    protected DepartmentCreate $departmentCreate;
    protected DepartmentUpdate $departmentUpdate;
    protected DepartmentGetAll $departmentGetAll;
    protected DepartmentGetOneById $departmentGetOneById;
    protected DepartmentDelete $departmentDelete;

    use HttpResponses;

    public function __construct(
        DepartmentCreate $department_create,
        DepartmentUpdate $department_update,
        DepartmentGetAll $department_get_all,
        DepartmentGetOneById $department_get_one_by_id,
        DepartmentDelete $department_delete,
    ) {
        $this->departmentCreate = $department_create;
        $this->departmentUpdate = $department_update;
        $this->departmentGetAll = $department_get_all;
        $this->departmentGetOneById = $department_get_one_by_id;
        $this->departmentDelete = $department_delete;
    }

    public function createDepartment(Request $request)
    {

        $name = $request->name;
        $description = $request->description;
        $id_country = (int) $request->id_country;

        $this->departmentCreate->run($name, $description, $id_country);

        return $this->created([], "Departamento creado exitosamente");
    }
    public function updateDepartment(Request $request)
    {
        $id = (int) $request->id;
        $name = $request->name;
        $description = $request->description;
        $id_country = (int) $request->id_country;

        $this->departmentUpdate->run($id, $name, $description, $id_country);

        return $this->success([], "Departamento actualizado exitosamente");
    }
    public function getOneByIdDepartment(Request $request, int $id)
    {

        $department = $this->departmentGetOneById->run($id);
        
        return $this->success(DepartmentDtoHttp::fromEntity($department), "Success");
    }
    public function getAllDepartment(Request $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $departmentsCollection = $this->departmentGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => DepartmentDtoHttp::fromEntity($item), $departmentsCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $departmentsCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deleteDepartment(Request $request, int $id)
    {
        $this->departmentDelete->run($id);

        return $this->success([], "Registro de departamento borrado exitosamente");
    }
}
