<?php
namespace Src\modules\catalogs\domain\repositories\department;

use Src\modules\catalogs\domain\entities\department\Department;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentId;

interface DepartmentRepositoryInterface {
    public function create(Department $department) : void;
    public function update(Department $department) : void;
    /**
     * @return Department[];
     */
    public function getAll(?int $page, ?int $per_page, ?string $filter_name = null) : array;
    public function getOneById(DepartmentId $id): ?Department;
    public function delete(DepartmentId $id) : void;
    public function getAllWithCountry(int $page, int $per_page, ?string $filter_name=null) : array;
}
