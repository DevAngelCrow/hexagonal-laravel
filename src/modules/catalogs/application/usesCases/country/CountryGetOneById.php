<?php
namespace Src\modules\catalogs\application\usesCases\country;

use Src\modules\catalogs\domain\entities\country\Country;
use Src\modules\catalogs\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryId;

class CountryGetOneById {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(int $id) : Country {
        return $this->countryRepository->getOneById(new CountryId($id));
    }
}