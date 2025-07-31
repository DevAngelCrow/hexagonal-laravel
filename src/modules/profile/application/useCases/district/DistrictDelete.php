<?php

namespace Src\modules\profile\application\useCases\district;

use Src\modules\profile\domain\repositories\district\DistrictRepositoryInterface;
use Src\modules\profile\domain\value_objects\district_value_object\DistrictId;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class DistrictDelete
{
    private readonly DistrictRepositoryInterface $districtRepository;

    public function __construct(DistrictRepositoryInterface $district_repository)
    {
        $this->districtRepository = $district_repository;
    }

    public function run(int $id): void
    {

        $district = $this->districtRepository->getOneById(new DistrictId($id));

        if (!$district) {
            throw new ApplicationException("Identificador del distrito no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->districtRepository->delete($district->getId());
    }
}
