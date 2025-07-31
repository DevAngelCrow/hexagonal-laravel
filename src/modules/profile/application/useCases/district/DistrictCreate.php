<?php
namespace Src\modules\profile\application\useCases\district;

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

    public function run(string $name, string $description, int $id_municipality, bool $state) : void {
        $district = new District(
            new DistrictIdMunicipality($id_municipality),
            new DistrictName($name),
            new DistrictDescription($description),
            new DistrictState($state)
        );

        $this->districtRepository->create($district);
    }
}