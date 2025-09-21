<?php
namespace Src\modules\catalogs\domain\repositories\municipality;

use Src\modules\catalogs\domain\entities\municipality\Municipality;
use Src\modules\catalogs\domain\value_objects\municipality_value_object\MunicipalityId;

interface MunicipalityRepositoryInterface {
    public function create(Municipality $country) : void;
    public function update(Municipality $country) : void;
    /**
     * @return Municipality[];
     */
    public function getAll(?int $page, ?int $per_page) : array;
    public function getOneById(MunicipalityId $id): ?Municipality;
    public function delete(MunicipalityId $id) : void;
    public function getAllWithDepartment(int $page, int $per_page) : array;
}
