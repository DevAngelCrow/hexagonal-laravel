<?php
namespace Src\modules\profile\application\useCases\department;

use Src\modules\profile\application\dtos\DepartmentDto;
use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentActive;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentName;

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