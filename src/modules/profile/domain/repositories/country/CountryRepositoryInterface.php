<?php
namespace Src\modules\profile\domain\repositories\country;

use Src\modules\profile\domain\entities\country\Country;
use Src\modules\profile\domain\value_objects\country_value_object\CountryId;

interface CountryRepositoryInterface {
    public function create(Country $country) : void;
    public function update(Country $country) : void;
    /**
     * @return Country[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(CountryId $id): ?Country;
    public function delete(CountryId $id) : void; 
}