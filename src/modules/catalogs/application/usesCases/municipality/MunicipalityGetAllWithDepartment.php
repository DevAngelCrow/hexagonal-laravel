<?php
namespace Src\modules\catalogs\application\usesCases\municipality;

use Src\modules\catalogs\domain\repositories\municipality\MunicipalityRepositoryInterface;

class MunicipalityGetAllWithDepartment {
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(?int $page, ?int $per_page, ?string $filter_name) : array {
        return $this->municipalityRepository->getAllWithDepartment($page, $per_page, $filter_name);
    }
}