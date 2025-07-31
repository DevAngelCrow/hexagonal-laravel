<?php
namespace Src\modules\profile\application\useCases\department;

use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;

class DepartmentGetAll {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(int $page, int $per_page) : array {
        return $this->departmentRepository->getAll($page, $per_page);
    }
}