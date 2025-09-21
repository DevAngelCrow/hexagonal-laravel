<?php
namespace Src\modules\catalogs\application\usesCases\district;

use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictId;

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