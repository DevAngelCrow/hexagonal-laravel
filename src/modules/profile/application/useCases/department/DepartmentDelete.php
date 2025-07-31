<?php

namespace Src\modules\profile\application\useCases\department;

use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentId;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DepartmentDelete
{
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(int $id): void
    {

        $department = $this->departmentRepository->getOneById(new DepartmentId($id));

        if (!$department) {
            throw new ApplicationException("Identificador de departamento no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->departmentRepository->delete($department->getId());
    }
}
