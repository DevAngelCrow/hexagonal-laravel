<?php
namespace Src\modules\security\domain\repositories\rol;

use Src\modules\security\domain\entities\rol\Rol;
use Src\modules\security\domain\value_objects\rol_value_object\RolId;

interface RolRepositoryInterface {
    public function create(Rol $rol) : void;
    public function update(Rol $rol) : void;
    /**
     * @return Rol[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(RolId $id): ?Rol;
    public function delete(RolId $id) : void;
}