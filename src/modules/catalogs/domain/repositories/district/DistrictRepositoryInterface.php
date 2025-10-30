<?php
namespace Src\modules\catalogs\domain\repositories\district;

use Src\modules\catalogs\domain\entities\district\District;
use Src\modules\catalogs\domain\value_objects\district_value_object\DistrictId;

interface DistrictRepositoryInterface {
    public function create(District $district) : void;
    public function update(District $district) : void;
    /**
     * @return District[];
     */
    public function getAll(?int $page, ?int $per_page) : array;
    public function getOneById(DistrictId $id): ?District;
    public function delete(DistrictId $id) : void;
    public function getAllDistrictWithMunicipality(?int $page, ?int $per_page, ?string $filter_name = null) : array;
}
