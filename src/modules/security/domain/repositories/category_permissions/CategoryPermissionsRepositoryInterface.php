<?php
namespace Src\modules\security\domain\repositories\category_permissions;

use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsId;

interface CategoryPermissionsRepositoryInterface {
    public function create(CategoryPermissions $category_permissions) : void;
    public function update(CategoryPermissions $category_permissions) : void;
    /**
     * @return CategoryPermissions[];
     */
    public function getAll(int $page, int $per_page) : array;
    public function getOneById(CategoryPermissionsId $id): ?CategoryPermissions;
    public function delete(CategoryPermissionsId $id) : void;
}