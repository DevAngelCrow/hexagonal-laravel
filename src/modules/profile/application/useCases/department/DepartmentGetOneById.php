<?php
namespace Src\modules\profile\application\useCases\department;

use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentId;

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