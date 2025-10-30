<?php

namespace Src\modules\catalogs\infrastructure\controllers;

use App\Http\Controllers\Controller;
use Src\modules\catalogs\application\dtos\DepartmentDto;
use Src\modules\catalogs\application\usesCases\department\DepartmentCreate;
use Src\modules\catalogs\application\usesCases\department\DepartmentDelete;
use Src\modules\catalogs\application\usesCases\department\DepartmentGetAll;
use Src\modules\catalogs\application\usesCases\department\DepartmentGetAllWithCountry;
use Src\modules\catalogs\application\usesCases\department\DepartmentGetOneById;
use Src\modules\catalogs\application\usesCases\department\DepartmentUpdate;
use Src\modules\catalogs\infrastructure\dtos\departmentDtoHttpResponse\DepartmentAggregateDtoHttp;
use Src\modules\catalogs\infrastructure\dtos\departmentDtoHttpResponse\DepartmentDtoHttp;
use Src\modules\catalogs\infrastructure\validators\department\CreateDepartmentRequest;
use Src\modules\catalogs\infrastructure\validators\department\DeleteDepartmentRequest;
use Src\modules\catalogs\infrastructure\validators\department\GetAllDepartmentRequest;
use Src\modules\catalogs\infrastructure\validators\department\GetByIdDepartmentRequest;
use Src\modules\catalogs\infrastructure\validators\department\UpdateDepartmentRequest;
use Src\shared\infrastructure\generalDtos\PaginatedResponseDto;
use Src\shared\infrastructure\HttpResponses;

class DepartmentController extends Controller
{
    protected DepartmentCreate $departmentCreate;
    protected DepartmentUpdate $departmentUpdate;
    protected DepartmentGetAll $departmentGetAll;
    protected DepartmentGetOneById $departmentGetOneById;
    protected DepartmentDelete $departmentDelete;
    protected DepartmentGetAllWithCountry $departmentGetAllWithCountry;

    use HttpResponses;

    public function __construct(
        DepartmentCreate $department_create,
        DepartmentUpdate $department_update,
        DepartmentGetAll $department_get_all,
        DepartmentGetOneById $department_get_one_by_id,
        DepartmentDelete $department_delete,
        DepartmentGetAllWithCountry $department_get_all_with_country
    ) {
        $this->departmentCreate = $department_create;
        $this->departmentUpdate = $department_update;
        $this->departmentGetAll = $department_get_all;
        $this->departmentGetOneById = $department_get_one_by_id;
        $this->departmentDelete = $department_delete;
        $this->departmentGetAllWithCountry = $department_get_all_with_country;
    }

    public function createDepartment(CreateDepartmentRequest $request)
    {

        $department = new DepartmentDto(
            $request->name,
            $request->description,
            (int) $request->id_country,
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
        $departmentCollection = $this->departmentGetAll->run($request->query("page"), $request->query("per_page"));
        if ($request->query("page") && $request->query("per_page")) {
            $collections = array_map(fn($item) => DepartmentDtoHttp::fromEntity($item), $departmentCollection["data"]);
            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $departmentCollection["pagination"]);
            return $this->success($paginateData, "Success");
        }

        $data = array_map(fn($item) => DepartmentDtoHttp::fromEntity($item), $departmentCollection);

        return $this->success($data, "Success");
    }
    public function deleteDepartment(DeleteDepartmentRequest $request)
    {
        $this->departmentDelete->run($request->id);

        return $this->success([], "Registro de departamento borrado exitosamente");
    }
    public function getAllDepartmentWithCountry(GetAllDepartmentRequest $request)
    {
        $page = $request->query("page");
        $per_page = $request->query("per_page");
        $filter_name = $request->query("filter_name");

        $deparmentsCollection = $this->departmentGetAllWithCountry->run($page, $per_page, $filter_name);
        if ($page && $per_page) {
            $collections = array_map(fn($item) => DepartmentAggregateDtoHttp::fromAggregate($item)->toArray(), $deparmentsCollection["data"]);

            $paginateData = PaginatedResponseDto::fromPaginatedResponse($collections, $deparmentsCollection["pagination"]);

            return $this->success($paginateData, "Success");
        }
        $data = array_map(fn($item) => DepartmentAggregateDtoHttp::fromAggregate($item)->toArray(), $deparmentsCollection);
        return $this->success($data, "Success");
    }
}
