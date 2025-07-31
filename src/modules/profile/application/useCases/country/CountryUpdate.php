<?php
namespace Src\modules\profile\application\useCases\country;

use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\profile\domain\value_objects\country_value_object\CountryAbbreviation;
use Src\modules\profile\domain\value_objects\country_value_object\CountryCode;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;
use Src\modules\profile\domain\value_objects\country_value_object\CountryName;
use Src\modules\profile\domain\value_objects\country_value_object\CountryState;
use Src\shared\domain\ApplicationException;
use Src\shared\domain\HttpStatusCode;

class CountryUpdate {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(int $id, string $name, string $abbreviation, string $code, bool $state) : void {
        
        $countryDb = $this->countryRepository->getOneById(new CountryId($id));

        if(!$countryDb){
            throw new ApplicationException("Identificador del país no encontrado en los registros", HttpStatusCode::HTTP_BAD_REQUEST->value);
        }
        
        $country = new Country(
            new CountryName($name),
            new CountryAbbreviation($abbreviation),
            new CountryCode($code),
            new CountryState($state),
            new CountryId($id)
        );

        $this->countryRepository->update($country);
    }
}