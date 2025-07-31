<?php
namespace Src\modules\profile\application\useCases\department;

use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentName;

class DepartmentCreate {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(string $name, string $description, int $id_country) : void {
        $department = new Department(
            new DepartmentName($name),
            new DepartmentDescription($description),
            new DepartmentIdCountry($id_country)
        );

        $this->departmentRepository->create($department);
    }
}