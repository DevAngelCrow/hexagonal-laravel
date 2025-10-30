<?php

namespace Src\modules\catalogs\infrastructure\implementation\DistrictRepositoryImplementation;

use App\Models\CtlDistrict as DistrictModel;
use Exception;
use Src\modules\catalogs\domain\aggregate\district\DistrictWithMunicipality;
use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\entities\municipality\Municipality;
use Src\modules\catalogs\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictId;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictName;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictState;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityActive;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityDescription;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityId;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityIdDepartment;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityName;
use Src\shared\infrastructure\exceptions\InfrastructureException;
use Symfony\Component\HttpFoundation\Response;

class ImplDistrictRepository implements DistrictRepositoryInterface
{
    private $districtsArray = [];
    public function create(District $district): void
    {
        try {
            $districtModel = new DistrictModel();

            $districtModel->name = $district->getName()->value();
            $districtModel->description = $district->getDescription()->value();
            $districtModel->id_municipality = $district->getIdMunicipality()->value();
            //$districtModel->active = $district->getActive()->value();

            $districtModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function update(District $district): void
    {
        try {
            $districtModel = DistrictModel::find($district->getId()->value());

            $districtModel->name = $district->getName()->value();
            $districtModel->description = $district->getDescription()->value();
            $districtModel->id_municipality = $district->getIdMunicipality()->value();
            //$districtModel->active = $district->getActive()->value();

            $districtModel->save();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getOneById(DistrictId $id): ?District
    {
        try {
            $districtModel = DistrictModel::find($id->value());

            if (!$districtModel) {
                throw new InfrastructureException("Identificador de distrito no encontrado en los registros", Response::HTTP_NOT_FOUND);
            }

            $district = $this->mapToDomain($districtModel);

            return $district;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAll(?int $page, ?int $per_page): array
    {
        try {
            $query = DistrictModel::select('id', 'name', 'description', 'id_municipality', 'active')->orderBy("id");
            if ($page !== null || $per_page !== null) {
                $districtsModels = $query->paginate($per_page);
                $data = array_map(fn($item) => $this->mapToDomain($item), $districtsModels->items());

                return $this->districtsArray = [
                    "data" => $data,
                    "pagination" => [
                        'current_page' => $districtsModels->currentPage(),
                        'last_page' => $districtsModels->lastPage(),
                        'per_page' => $districtsModels->perPage(),
                        'total' => $districtsModels->total(),
                    ]
                ];
            }
            $districtsModels = $query->get();

            $this->districtsArray = array_map(fn($item) => $this->mapToDomain($item), $districtsModels->all());
            return $this->districtsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(districtId $id): void
    {
        try {
            $districtModel = DistrictModel::find($id->value());

            $districtModel->active = false;
            $districtModel->save();
            //$districtModel->delete();
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function getAllDistrictWithMunicipality(?int $page, ?int $per_page, ?string $filter_name = null): array
    {
        try {
            $query = DistrictModel::select('id', 'name', 'description', 'active', 'id_municipality')->orderBy('id');
            if ($filter_name !== null || $filter_name !== '') {
                $query->where('name', 'ILIKE', "%{$filter_name}%");
            }

            if ($page !== null && $per_page !== null) {
                $districtModels = $query->paginate($per_page);

                $data = array_map(fn($item) => $this->mapToAggregateDomain($item), $districtModels->items());

                $this->districtsArray = [
                    "data" => $data,
                    "pagination" => [
                        'currentPage' => $districtModels->currentPage(),
                        'lastPage' => $districtModels->lastPage(),
                        'perPage' => $districtModels->perPage(),
                        'totalItems' => $districtModels->total(),
                    ]
                ];
                return $this->districtsArray;
            }
            $districtModels = $query->get();
            $this->districtsArray = array_map(fn($item) => $this->mapToAggregateDomain($item), $districtModels->all());
            return $this->districtsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function mapToDomain(districtModel $district)
    {
        //dd($district);
        $districtMapped = new District(
            new DistrictIdMunicipality($district->id_municipality),
            new DistrictName($district->name),
            new DistrictDescription($district->description),
            new DistrictState($district->active),
            new districtId($district->id)
        );

        return $districtMapped;
    }
    private function mapToAggregateDomain(DistrictModel $district): DistrictWithMunicipality
    {
        $municipality = $this->mapToDomainDistrict($district);
        $municipalityMapped = new DistrictWithMunicipality(
            $municipality,
            new District(
                new DistrictIdMunicipality($district->id_municipality),
                new DistrictName($district->name),
                new DistrictDescription($district->description),
                new DistrictState($district->active),
                new DistrictId($district->id)
            ),
        );

        return $municipalityMapped;
    }
    private function mapToDomainDistrict(DistrictModel $district): Municipality
    {

        $municipality = $district->municipality;
        $municipalityMapped = new Municipality(
            new MunicipalityName($municipality->name),
            new MunicipalityDescription($municipality->description),
            new MunicipalityIdDepartment($municipality->id_department),
            new MunicipalityActive($municipality->active),
            new MunicipalityId($municipality->id)
        );
        return $municipalityMapped;
    }
}
