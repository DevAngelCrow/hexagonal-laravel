<?php

namespace Src\modules\profile\infrastructure\implementation\DepartmentRepositoryImplementation;

use App\Models\CtlDepartment as DepartmentModel;
use Exception;
use Src\modules\profile\domain\aggregate\department\DepartmentWithCountry;
use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\repositories\department\DepartmentRepositoryInterface;
use Src\modules\profile\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\profile\domain\value_objects\country_value_object\CountryCode;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;
use Src\modules\profile\domain\value_objects\country_value_object\CountryName;
use Src\modules\profile\domain\value_objects\country_value_object\CountryState;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentActive;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentId;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplDepartmentRepository implements DepartmentRepositoryInterface
{
    private $departmentsArray = [];
    public function create(Department $department): void
    {
        try {
            $departmentModel = new DepartmentModel();

            $departmentModel->name = $department->getName()->value();
            $departmentModel->description = $department->getDescription()->value();
            $departmentModel->id_country = $department->getIdCountry()->value();
            $departmentModel->active = $department->getActive()->value();

            $departmentModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Department $department): void
    {
        try {
            $departmentModel = DepartmentModel::find($department->getId()->value());

            $departmentModel->name = $department->getName()->value();
            $departmentModel->description = $department->getDescription()->value();
            $departmentModel->id_country = $department->getIdCountry()->value();
            $departmentModel->active = $department->getActive()->value();

            $departmentModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(DepartmentId $id): ?Department
    {
        try {
            $departmentModel = DepartmentModel::find($id->value());

            if (!$departmentModel) {
                throw new InfrastructureException("Identificador de departamento no encontrado en los registros", Response::HTTP_NOT_FOUND);
            }

            $department = $this->mapToDomain($departmentModel);

            return $department;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(int $page, int $per_page): array
    {
        try {
            $departmentsModels = DepartmentModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $departmentsModels->items());
            $this->departmentsArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $departmentsModels->currentPage(),
                    'last_page' => $departmentsModels->lastPage(),
                    'per_page' => $departmentsModels->perPage(),
                    'total' => $departmentsModels->total(),
                ]
            ];

            return $this->departmentsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(DepartmentId $id): void
    {
        try {
            $departmentModel = DepartmentModel::find($id->value());

            $departmentModel->active = false;
            $departmentModel->save();
            $departmentModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllWithCountry(int $page, int $per_page): array
    {
        
        try {
            $departmentModels =  DepartmentModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToAggregateDomain($item), $departmentModels->items());

            $this->departmentsArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $departmentModels->currentPage(),
                    'last_page' => $departmentModels->lastPage(),
                    'per_page' => $departmentModels->perPage(),
                    'total' => $departmentModels->total(),
                ]
            ];
            return $this->departmentsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(DepartmentModel $department)
    {
        $departmentMapped = new department(
            new DepartmentName($department->name),
            new DepartmentDescription($department->description),
            new DepartmentIdCountry($department->id_country),
            new DepartmentActive($department->active),
            new DepartmentId($department->id)
        );

        return $departmentMapped;
    }
    private function mapToAggregateDomain(DepartmentModel $department): DepartmentWithCountry
    {
        $country = $this->mapToDomainCountry($department);
        $departmentMapped = new DepartmentWithCountry(
            $country,
            new department(
            new DepartmentName($department->name),
            new DepartmentDescription($department->description),
            new DepartmentIdCountry($department->id_country),
            new DepartmentActive($department->active),
            new DepartmentId($department->id))
        );

        return $departmentMapped;
    }
    private function mapToDomainCountry(DepartmentModel $department): Country
    {
        
        $country = $department->country;
        $countryMapped = new Country(
            new CountryName($country->name),
            new CountryAbbreviation($country->abbreviation),
            new CountryCode($country->code),
            new CountryState($country->active),
            new CountryId($country->id)
        );
        return $countryMapped;
    }
}
