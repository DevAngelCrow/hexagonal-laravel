<?php
namespace Src\modules\profile\application\useCases\district;

use Src\modules\profile\application\dtos\DistrictDto;
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

    public function run(DistrictDto $districtDto) : void {
        
        $districtDb = $this->districtRepository->getOneById(new DistrictId($districtDto->id));

        if(!$districtDb){
            throw new ApplicationException("Identificador del distrito no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $district = new District(
            new DistrictIdMunicipality($districtDto->id_municipality),
            new DistrictName($districtDto->name),
            new DistrictDescription($districtDto->description),
            new DistrictState($districtDto->state),
            $districtDb->getId(),
        );

        $this->districtRepository->update($district);
    }
}