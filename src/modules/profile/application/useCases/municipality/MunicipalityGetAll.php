<?php
namespace Src\modules\profile\application\useCases\municipality;

use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;

class MunicipalityGetAll {
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(int $page, int $per_page) : array {
        return $this->municipalityRepository->getAll($page, $per_page);
    }
}