<?php
namespace Src\modules\profile\application\useCases\district;

use Src\modules\profile\application\dtos\DistrictDto;
use Src\modules\profile\domain\entities\district\District;
use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictDescription;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictIdMunicipality;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictName;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictState;

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