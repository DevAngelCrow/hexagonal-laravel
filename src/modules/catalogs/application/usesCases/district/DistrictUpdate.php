<?php
namespace Src\modules\catalogs\application\usesCases\district;

use Src\modules\catalogs\application\dtos\DistrictDto;
use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictId;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictName;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictState;
use Src\shared\application\exceptions\ApplicationException;
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
            new DistrictState($districtDto->active),
            $districtDb->getId(),
        );

        $this->districtRepository->update($district);
    }
}