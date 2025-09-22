<?php
namespace Src\modules\catalogs\application\usesCases\district;

use Src\modules\catalogs\application\dtos\DistrictDto;
use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictName;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictState;

class DistrictCreate {
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(DistrictDto $districtDto) : void {
        $district = new District(
            new DistrictIdMunicipality($districtDto->id_municipality),
            new DistrictName($districtDto->name),
            new DistrictDescription($districtDto->description),
            new DistrictState($districtDto->active)
        );

        $this->districtRepository->create($district);
    }
}