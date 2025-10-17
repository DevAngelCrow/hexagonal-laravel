<?php
namespace Src\modules\security\infrastructure\dtos\permissionsDtoHttpResponse;

use Src\modules\security\domain\aggregate\permissions\PermissionWithCategory;

class PermissionsAggregateDtoHttp {
    public function __construct(public readonly PermissionWithCategory $permissionWithCategory)
    {
        
    }
    public static function fromAggregate(PermissionWithCategory $permissionWithCategory) : self{
        return new self($permissionWithCategory);
    }
    public function toArray() : array {
        $permission = $this->permissionWithCategory->getPermissions();
        $category = $this->permissionWithCategory->getCategoryPermissions();
        $permissionMappedData = [
            "id" => $permission->getId()->value(),
            "name" => $permission->getName()->value(),
            "description" => $permission->getDescription()->value(),
            "active" => $permission->getActive()->value()
        ];
        $categoryMappedData = [
            "id" => $category->getId()->value(),
            "name" => $category->getName()->value(),
            "description" => $category->getDescription()->value()
        ];

        $permissionMappedData["category"] = $categoryMappedData;
        
        return $permissionMappedData;
    }
}