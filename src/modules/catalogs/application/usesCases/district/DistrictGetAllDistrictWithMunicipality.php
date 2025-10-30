<?php
namespace Src\modules\catalogs\application\usesCases\district;

use Src\modules\catalogs\domain\repositories\district\DistrictRepositoryInterface;

class DistrictGetAllDistrictWithMunicipality {
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(?int $page, ?int $per_page, ?string $filter_name) : array {
        return $this->districtRepository->getAllDistrictWithMunicipality($page, $per_page, $filter_name);
    }
}