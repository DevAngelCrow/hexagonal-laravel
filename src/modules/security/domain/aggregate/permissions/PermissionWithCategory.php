<?php
namespace Src\modules\security\domain\aggregate\permissions;

use Src\modules\security\domain\entities\category_permissions\CategoryPermissions;
use Src\modules\security\domain\entities\permissions\Permissions;

class PermissionWithCategory {
    private Permissions $permissions;
    private CategoryPermissions $category_permissions;

    public function __construct(Permissions $permissions, CategoryPermissions $category_permissions){
        $this->permissions = $permissions;
        $this->category_permissions = $category_permissions;
    }

    public function getPermissions() : Permissions {
        return $this->permissions;
    }
    public function getCategoryPermissions() : CategoryPermissions {
        return $this->category_permissions;
    }
}