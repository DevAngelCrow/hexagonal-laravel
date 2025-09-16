<?php
namespace Src\modules\catalogs\domain\repositories;

use Src\modules\catalogs\domain\entities\GlobalStatus;
use Src\modules\catalogs\domain\value_objects\global_status_value_objects\GlobalStatusId;

interface GlobalStatusRepositoryInterface{
    public function create(GlobalStatus $globalStatus) : void;
    public function update(GlobalStatus $globalStatus) : void;
    /**
     * @return GlobalStatus[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(GlobalStatusId $id): ?GlobalStatus;
    public function delete(GlobalStatusId $id) : void;
}
