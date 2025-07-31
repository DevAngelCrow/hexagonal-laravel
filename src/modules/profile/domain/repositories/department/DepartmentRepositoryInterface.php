<?php
namespace Src\modules\profile\domain\repositories\department;

use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentId;

interface DepartmentRepositoryInterface {
    public function create(Department $department) : void;
    public function update(Department $department) : void;
    /**
     * @return Department[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(DepartmentId $id): ?Department;
    public function delete(DepartmentId $id) : void; 
}