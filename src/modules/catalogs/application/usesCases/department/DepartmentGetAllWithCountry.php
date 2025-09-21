<?php
namespace Src\modules\catalogs\application\usesCases\department;

use Src\modules\catalogs\domain\repositories\department\DepartmentRepositoryInterface;

class DepartmentGetAllWithCountry {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(int $page, int $per_page) : array {
        return $this->departmentRepository->getAllWithCountry($page, $per_page);
    }
}