<?php

namespace Src\modules\profile\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Src\modules\profile\application\dtos\DepartmentDto;
use Src\modules\profile\application\useCases\department\DepartmentCreate;
use Src\modules\profile\application\useCases\department\DepartmentDelete;
use Src\modules\profile\application\useCases\department\DepartmentGetAll;
use Src\modules\profile\application\useCases\department\DepartmentGetOneById;
use Src\modules\profile\application\useCases\department\DepartmentUpdate;
use Src\modules\profile\infrastructure\dtos\departmentDtoHttpResponse\DepartmentDtoHttp;
use Src\modules\profile\infrastructure\validators\department\CreateDepartmentRequest;
use Src\modules\profile\infrastructure\validators\department\DeleteDepartmentRequest;
use Src\modules\profile\infrastructure\validators\department\GetAllDepartmentRequest;
use Src\modules\profile\infrastructure\validators\department\GetByIdDepartmentRequest;
use Src\modules\profile\infrastructure\validators\department\UpdateDepartmentRequest;
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

    public function createDepartment(CreateDepartmentRequest $request)
    {

        $department = new DepartmentDto(
            $request->name,
            $request->description,
            (int) $request->id_country,
            $request->active
        );

        $this->departmentCreate->run($department);

        return $this->created([], "Departamento creado exitosamente");
    }
    public function updateDepartment(UpdateDepartmentRequest $request)
    {
        $department = new DepartmentDto(
            $request->name,
            $request->description,
            $request->id_country,
            $request->active,
            $request->id
        );
        $this->departmentUpdate->run($department);

        return $this->success([], "Departamento actualizado exitosamente");
    }
    public function getOneByIdDepartment(GetByIdDepartmentRequest $request)
    {

        $department = $this->departmentGetOneById->run($request->id);
        
        return $this->success(DepartmentDtoHttp::fromEntity($department), "Success");
    }
    public function getAllDepartment(GetAllDepartmentRequest $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");

        $departmentsCollection = $this->departmentGetAll->run($page, $per_page);

        $collections = array_map(fn($item) => DepartmentDtoHttp::fromEntity($item), $departmentsCollection["data"]);

        $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $departmentsCollection["pagination"]);

        return $this->success($paginateData, "Success");
    }
    public function deleteDepartment(DeleteDepartmentRequest $request)
    {
        $this->departmentDelete->run($request->id);

        return $this->success([], "Registro de departamento borrado exitosamente");
    }
}
