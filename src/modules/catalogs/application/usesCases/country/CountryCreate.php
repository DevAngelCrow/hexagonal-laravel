<?php
namespace Src\modules\catalogs\application\usesCases\country;

use Src\modules\catalogs\application\dtos\CountryDto;
use Src\modules\catalogs\domain\entities\country\Country;
use Src\modules\catalogs\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryCode;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryName;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryState;

class CountryCreate {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(CountryDto $countryDto) : void {
        $country = new Country(
            new CountryName($countryDto->name),
            new CountryAbbreviation($countryDto->abbreviation),
            new CountryCode($countryDto->code),
            new CountryState($countryDto->active)
        );

        $this->countryRepository->create($country);
    }
}