<?php
namespace Src\modules\catalogs\application\usesCases\country;

use Src\modules\catalogs\domain\repositories\country\CountryRepositoryInterface;

class CountryGetAll {
    private readonly CountryRepositoryInterface $countryRepository;

    public function __construct(CountryRepositoryInterface $country_repository)
    {
        $this->countryRepository = $country_repository;
    }

    public function run(?int $page, ?int $per_page, ?string $filter_name = null) : array {
        return $this->countryRepository->getAll($page, $per_page, $filter_name);
    }
}