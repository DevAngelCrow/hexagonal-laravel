<?php
namespace Src\modules\catalogs\application\usesCases\country;

use Src\modules\catalogs\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryId;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class CountryDelete
{
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(int $id): void
    {

        $country = $this->countryRepository->getOneById(new CountryId($id));

        if (!$country) {
            throw new ApplicationException("Identificador de documento no encontrado", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }

        $this->countryRepository->delete($country->getId());
    }
}
