<?php
namespace Src\modules\catalogs\application\usesCases\department;

use Src\modules\catalogs\application\dtos\DepartmentDto;
use Src\modules\catalogs\domain\entities\department\Department;
use Src\modules\catalogs\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentActive;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentName;

class DepartmentCreate {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(DepartmentDto $departmentDto) : void {
        $department = new Department(
            new DepartmentName($departmentDto->name),
            new DepartmentDescription($departmentDto->description),
            new DepartmentIdCountry($departmentDto->id_country),
            new DepartmentActive($departmentDto->active)
        );

        $this->departmentRepository->create($department);
    }
}