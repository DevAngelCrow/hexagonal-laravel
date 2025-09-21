<?php
namespace Src\modules\catalogs\application\usesCases\country;

use Src\modules\catalogs\application\dtos\CountryDto;
use Src\modules\catalogs\domain\entities\country\Country;
use Src\modules\catalogs\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryCode;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryId;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryName;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryState;
use Src\shared\application\exceptions\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class CountryUpdate {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(CountryDto $countryDto) : void {
        
        $countryDb = $this->countryRepository->getOneById(new CountryId($countryDto->id));

        if(!$countryDb){
            throw new ApplicationException("Identificador del país no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $country = new Country(
            new CountryName($countryDto->name),
            new CountryAbbreviation($countryDto->abbreviation),
            new CountryCode($countryDto->code),
            new CountryState($countryDto->active),
            new CountryId($countryDto->id)
        );

        $this->countryRepository->update($country);
    }
}