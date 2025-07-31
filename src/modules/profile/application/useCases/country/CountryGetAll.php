<?php
namespace Src\modules\profile\application\useCases\country;

use Src\modules\profile\domain\repositories\country\CountryRepositoryInterface;

class CountryGetAll {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(int $page, int $per_page) : array {
        return $this->countryRepository->getAll($page, $per_page);
    }
}