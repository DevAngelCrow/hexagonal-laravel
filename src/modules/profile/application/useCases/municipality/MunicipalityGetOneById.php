<?php
namespace Src\modules\profile\application\useCases\municipality;

use Src\modules\profile\domain\entities\municipality\Municipality;
use Src\modules\profile\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityId;

class MunicipalityGetOneById {
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(int $id) : Municipality {
        return $this->municipalityRepository->getOneById(new MunicipalityId($id));
    }
}