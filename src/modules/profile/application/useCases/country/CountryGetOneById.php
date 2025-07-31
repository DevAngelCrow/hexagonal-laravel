<?php
namespace Src\modules\profile\application\useCases\country;

use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;

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