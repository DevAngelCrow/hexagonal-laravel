<?php
namespace Src\modules\security\domain\repositories\rol;

use Src\modules\security\domain\aggregate\role\RoleWithStatus;
use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;

interface RolRepositoryInterface {
    public function create(Rol $rol) :?Rol;
    public function update(Rol $rol) : void;
    /**
     * @return Rol[];
     */
    public function getAll(?int $page, ?int $per_page, ?string $filter_name = null) : array;
    public function getOneById(RolId $id): ?RoleWithStatus;
    public function getOneByIdEntity(RolId $id): ?Rol;
    public function delete(RolId $id, int $id_status) : void;
    public function getAllWithStatus(?int $page, ?int $per_page, ?string $filter_name = null) : array;
}