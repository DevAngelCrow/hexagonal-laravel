<?php
namespace Src\modules\profile\domain\repositories\municipality;

use Src\modules\profile\domain\entities\municipality\Municipality;
use Src\modules\profile\domain\value_objects\municipality_value_object\MunicipalityId;

interface MunicipalityRepositoryInterface {
    public function create(Municipality $country) : void;
    public function update(Municipality $country) : void;
    /**
     * @return Municipality[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(MunicipalityId $id): ?Municipality;
    public function delete(MunicipalityId $id) : void; 
}