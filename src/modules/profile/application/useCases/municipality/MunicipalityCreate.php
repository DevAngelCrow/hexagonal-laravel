<?php
namespace Src\modules\profile\application\useCases\municipality;

use Src\modules\profile\domain\entities\municipality\Municipality;
use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityDescription;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityIdDepartment;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityName;

class MunicipalityCreate {
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(string $name, string $description, int $id_department) : void {
        $municipality = new Municipality(
            new MunicipalityName($name),
            new MunicipalityDescription($description),
            new MunicipalityIdDepartment($id_department)
        );

        $this->municipalityRepository->create($municipality);
    }
}