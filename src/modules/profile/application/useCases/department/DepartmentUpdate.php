<?php
namespace Src\modules\profile\application\useCases\department;

use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentId;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentName;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DepartmentUpdate {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(int $id, string $name, string $description, int $id_country) : void {
        
        $departmentDb = $this->departmentRepository->getOneById(new DepartmentId($id));

        if(!$departmentDb){
            throw new ApplicationException("Identificador del país no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $department = new Department(
            new DepartmentName($name),
            new DepartmentDescription($description),
            new DepartmentIdCountry($id_country),
            new DepartmentId($id)
        );

        $this->departmentRepository->update($department);
    }
}