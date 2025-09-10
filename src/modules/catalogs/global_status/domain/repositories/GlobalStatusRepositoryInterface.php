<?php
namespace Src\modules\catalogs\global_status\domain\repositories;
use Src\modules\catalogs\global_status\domain\entities\GlobalStatus;
use Src\modules\catalogs\global_status\domain\value_objects\GlobalStatusId;


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
