<?php
namespace Src\modules\profile\application\useCases\district;

use Src\modules\profile\domain\entities\district\District;
use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictId;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictName;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictState;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DistrictUpdate {
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(int $id, string $name, string $description, int $id_municipality, bool $state) : void {
        
        $districtDb = $this->districtRepository->getOneById(new DistrictId($id));

        if(!$districtDb){
            throw new ApplicationException("Identificador del distrito no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $district = new District(
            new DistrictIdMunicipality($id_municipality),
            new DistrictName($name),
            new DistrictDescription($description),
            new DistrictState($state),
            $districtDb->getId(),
        );

        $this->districtRepository->update($district);
    }
}