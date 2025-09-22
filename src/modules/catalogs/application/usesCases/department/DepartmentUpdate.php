<?php
namespace Src\modules\catalogs\application\usesCases\department;

use Src\modules\catalogs\application\dtos\DepartmentDto;
use Src\modules\catalogs\domain\entities\department\Department;
use Src\modules\catalogs\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentActive;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentId;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\catalogs\domain\value_objects\department_value_object\DepartmentName;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DepartmentUpdate {
    private readonly DepartmentRepositoryInterface $departmentRepository;

    public function __construct(DepartmentRepositoryInterface $department_repository)
    {
        $this->departmentRepository = $department_repository;
    }

    public function run(DepartmentDto $departmentDto) : void {
        
        $departmentDb = $this->departmentRepository->getOneById(new DepartmentId($departmentDto->id));

        if(!$departmentDb){
            throw new ApplicationException("Identificador del país no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $department = new Department(
            new DepartmentName($departmentDto->name),
            new DepartmentDescription($departmentDto->description),
            new DepartmentIdCountry($departmentDto->id_country),
            new DepartmentActive($departmentDto->active),
            new DepartmentId($departmentDto->id)
        );

        $this->departmentRepository->update($department);
    }
}