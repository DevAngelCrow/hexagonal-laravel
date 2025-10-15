<?php
namespace Src\modules\catalogs\domain\repositories\country;

use Src\modules\catalogs\domain\entities\country\Country;
use Src\modules\catalogs\domain\value_objects\country_value_object\CountryId;

interface CountryRepositoryInterface {
    public function create(Country $country) : void;
    public function update(Country $country) : void;
    /**
     * @return Country[];
     */
    public function getAll(?int $page, ?int $per_page, ?string $filter_name = null) : array;
    public function getOneById(CountryId $id): ?Country;
    public function delete(CountryId $id) : void; 
}