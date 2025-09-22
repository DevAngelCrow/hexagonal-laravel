<?php

namespace Src\modules\catalogs\application\usesCases\municipality;

use Src\modules\catalogs\domain\repositories\municipality\MunicipalityRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class MunicipalityDelete
{
    private readonly MunicipalityRepositoryInterface $municipalityRepository;

    public function __construct(MunicipalityRepositoryInterface $municipality_repository)
    {
        $this->municipalityRepository = $municipality_repository;
    }

    public function run(int $id): void
    {

        $municipality = $this->municipalityRepository->getOneById(new MunicipalityId($id));

        if (!$municipality) {
            throw new ApplicationException("Identificador de municipalidad no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->municipalityRepository->delete($municipality->getId());
    }
}
