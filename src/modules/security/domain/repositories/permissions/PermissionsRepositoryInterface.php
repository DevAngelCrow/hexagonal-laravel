<?php
namespace Src\modules\security\domain\repositories\permissions;

use Src\modules\security\domain\entities\permissions\Permissions;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;

interface PermissionsRepositoryInterface {
    public function create(Permissions $permissions) : void;
    public function update(Permissions $permissions) : void;
    /**
     * @return Permissions[];
     */
    public function getAll(?int $page, ?int $per_page) : array;
    public function getOneById(PermissionsId $id): ?Permissions;
    public function delete(PermissionsId $id) : void;
}