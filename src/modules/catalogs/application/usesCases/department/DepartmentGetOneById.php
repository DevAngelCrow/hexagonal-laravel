<?php
namespace Src\modules\catalogs\application\usesCases\department;

use Src\modules\catalogs\domain\entities\department\Department;
use Src\modules\catalogs\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentId;

class DepartmentGetOneById {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(int $id) : Department {
        return $this->departmentRepository->getOneById(new DepartmentId($id));
    }
}