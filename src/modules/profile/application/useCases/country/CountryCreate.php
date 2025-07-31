<?php
namespace Src\modules\profile\application\useCases\country;

use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\profile\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\profile\domain\value_objects\country_value_object\CountryCode;
use Src\modules\profile\domain\value_objects\country_value_object\CountryName;
use Src\modules\profile\domain\value_objects\country_value_object\CountryState;

class CountryCreate {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(string $name, string $abbreviation, string $code, bool $state) : void {
        $country = new Country(
            new CountryName($name),
            new CountryAbbreviation($abbreviation),
            new CountryCode($code),
            new CountryState($state)
        );

        $this->countryRepository->create($country);
    }
}