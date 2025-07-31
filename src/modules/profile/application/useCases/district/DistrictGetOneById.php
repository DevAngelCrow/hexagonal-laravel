<?php
namespace Src\modules\profile\application\useCases\district;

use Src\modules\profile\domain\entities\district\District;
use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictId;

class DistrictGetOneById {
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(int $id) : District {
        return $this->districtRepository->getOneById(new DistrictId($id));
    }
}