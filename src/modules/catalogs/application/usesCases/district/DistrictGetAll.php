<?php
namespace Src\modules\catalogs\application\usesCases\district;

use Src\modules\catalogs\domain\repositories\district\DistrictRepositoryInterface;

class DistrictGetAll {
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(?int $page, ?int $per_page) : array {
        return $this->districtRepository->getAll($page, $per_page);
    }
}
