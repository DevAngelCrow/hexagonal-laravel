<?php
namespace Src\modules\profile\application\useCases\district;

use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;

class DistrictGetAllDistrictWithMunicipality {
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(int $page, int $per_page) : array {
        return $this->districtRepository->getAllDistrictWithMunicipality($page, $per_page);
    }
}