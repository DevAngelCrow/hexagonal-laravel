<?php
namespace Src\modules\catalogs\application\usesCases\municipality;

use Src\modules\catalogs\application\dtos\MunicipalityDto;
use Src\modules\catalogs\domain\entities\municipality\Municipality;
use Src\modules\catalogs\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityActive;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityDescription;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityIdDepartment;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityName;

class MunicipalityCreate {
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(MunicipalityDto $municipalityDto) : void {


        $municipality = new Municipality(
            new MunicipalityName($municipalityDto->name),
            new MunicipalityDescription($municipalityDto->description),
            new MunicipalityIdDepartment($municipalityDto->id_department),
            new MunicipalityActive($municipalityDto->active)
        );

        $this->municipalityRepository->create($municipality);
    }
}