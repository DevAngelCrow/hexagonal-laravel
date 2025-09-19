<?php

namespace Src\modules\profile\infrastructure\implementation\MunicipalityRepositoryImplementation;

use App\Models\CtlMunicipality as MunicipalityModel;
use Exception;
use Src\modules\profile\domain\aggregate\municipality\MunicipalityWithDepartment;
use Src\modules\profile\domain\entities\department\Department;
use Src\modules\profile\domain\entities\municipality\Municipality;
use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentActive;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentDescription;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentId;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentIdCountry;
use Src\modules\profile\domain\value_objects\department_value_object\DepartmentName;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityActive;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityDescription;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityId;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityIdDepartment;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplMunicipalityRepository implements MunicipalityRepositoryInterface
{
    private $municipalitiesArray = [];
    public function create(Municipality $municipality): void
    {
        try {
            $municipalityModel = new MunicipalityModel();

            $municipalityModel->name = $municipality->getName()->value();
            $municipalityModel->description = $municipality->getDescription()->value();
            $municipalityModel->id_department = $municipality->getIdDepartment()->value();
            $municipalityModel->active = $municipality->getActive()->value();

            $municipalityModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(Municipality $municipality): void
    {
        try {
            $municipalityModel = MunicipalityModel::find($municipality->getId()->value());

            $municipalityModel->name = $municipality->getName()->value();
            $municipalityModel->description = $municipality->getDescription()->value();
            $municipalityModel->id_department = $municipality->getIdDepartment()->value();
            $municipalityModel->active = $municipality->getActive()->value();

            $municipalityModel->save();

        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(MunicipalityId $id): ?Municipality
    {
        try {
            $municipalityModel = MunicipalityModel::find($id->value());

            if (!$municipalityModel) {
                throw new InfrastructureException("Identificador de municipio no encontrado en los registros", Response::HTTP_NOT_FOUND);
            }

            $municipality = $this->mapToDomain($municipalityModel);

            return $municipality;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page, ?int $per_page): array
    {
        try {

            $query = MunicipalityModel::select('id', 'name', 'description', 'id_department', 'active')->orderBy("id");
            if($page !== null && $per_page !==null){
                $municipalityModels = $query->paginate($per_page);
                $data = array_map(fn($item) => $this->mapToDomain($item), $municipalityModels->items());

                return $this->municipalitiesArray = [
                    "data" => $data,
                    "pagination" => [
                        'current_page' => $municipalityModels->currentPage(),
                        'last_page' => $municipalityModels->lastPage(),
                        'per_page' => $municipalityModels->perPage(),
                        'total' => $municipalityModels->total(),
                    ]
                ];
            }

            $municipalityModels = $query->get();

            $this->municipalitiesArray = array_map(fn($item) => $this->mapToDomain($item), $municipalityModels->all());
            return $this->municipalitiesArray;


        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(MunicipalityId $id): void
    {
        try {
            $municipalityModel = MunicipalityModel::find($id->value());

            $municipalityModel->active = false;
            $municipalityModel->save();
            $municipalityModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getAllWithDepartment(int $page, int $per_page): array
    {
        try {
            $municipalitiesModels =  MunicipalityModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToAggregateDomain($item), $municipalitiesModels->items());

            $this->municipalitiesArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $municipalitiesModels->currentPage(),
                    'last_page' => $municipalitiesModels->lastPage(),
                    'per_page' => $municipalitiesModels->perPage(),
                    'total' => $municipalitiesModels->total(),
                ]
            ];
            return $this->municipalitiesArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(MunicipalityModel $municipality)
    {
        //dd($municipality);
        $municipalityMapped = new Municipality(
            new MunicipalityName($municipality->name),
            new MunicipalityDescription($municipality->description),
            new MunicipalityIdDepartment($municipality->id_department),
            new MunicipalityActive($municipality->active),
            new MunicipalityId($municipality->id)
        );

        return $municipalityMapped;
    }

    private function mapToAggregateDomain(MunicipalityModel $municipality): MunicipalityWithDepartment
    {
        $department = $this->mapToDomainDepartment($municipality);
        $municipalityMapped = new MunicipalityWithDepartment(
            new Municipality(
            new MunicipalityName($municipality->name),
            new MunicipalityDescription($municipality->description),
            new MunicipalityIdDepartment($municipality->id_department),
            new MunicipalityActive($municipality->active),
            new MunicipalityId($municipality->id),
            ),
            $department
        );

        return $municipalityMapped;
    }
    private function mapToDomainDepartment(MunicipalityModel $municipality): Department
    {

        $department = $municipality->department;
        $departmentMapped = new Department(
            new DepartmentName($department->name),
            new DepartmentDescription($department->description),
            new DepartmentIdCountry($department->id_country),
            new DepartmentActive($department->active),
            new DepartmentId($department->id)
        );
        return $departmentMapped;
    }
}
