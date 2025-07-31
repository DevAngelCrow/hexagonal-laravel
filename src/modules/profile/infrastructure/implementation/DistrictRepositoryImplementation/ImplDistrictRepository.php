<?php

namespace Src\modules\profile\infrastructure\implementation\DistrictRepositoryImplementation;

use App\Models\CtlDistrict as DistrictModel;
use Exception;
use Src\modules\profile\domain\entities\district\District;
use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictId;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictName;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictState;
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
            $districtModel->state = $district->getState()->value();

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
            $districtModel->state = $district->getState()->value();

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
    public function getAll(int $page, int $per_page): array
    {
        try {
            $districtsModels = DistrictModel::orderBy("id")->paginate($per_page);
            $data = array_map(fn($item) => $this->mapToDomain($item), $districtsModels->items());
            $this->districtsArray = [
                "data" => $data,
                "pagination" => [
                    'current_page' => $districtsModels->currentPage(),
                    'last_page' => $districtsModels->lastPage(),
                    'per_page' => $districtsModels->perPage(),
                    'total' => $districtsModels->total(),
                ]
            ];

            return $this->districtsArray;
        } catch (Exception $e) {
            throw new InfrastructureException($e, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function delete(districtId $id): void
    {
        try {
            $districtModel = DistrictModel::find($id->value());

            $districtModel->state = false;
            $districtModel->save();
            $districtModel->delete();
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
            new DistrictState($district->state),
            new districtId($district->id)
        );

        return $districtMapped;
    }
}
