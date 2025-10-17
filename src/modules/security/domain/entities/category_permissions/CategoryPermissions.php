<?php
namespace Src\modules\security\domain\entities\category_permissions;

use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsActive;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsDescription;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsId;
use Src\modules\security\domain\value_objects\category_permissions_value_object\CategoryPermissionsName;

class CategoryPermissions {
    private readonly CategoryPermissionsName $name;
    private readonly CategoryPermissionsDescription $description;
    private readonly CategoryPermissionsActive $active;
    private readonly ?CategoryPermissionsId $id;

    public function __construct(CategoryPermissionsName $name, CategoryPermissionsDescription $description, ?CategoryPermissionsActive $active = null,?CategoryPermissionsId $id = null)
    {
        $this->name = $name;
        $this->description = $description;
        $this->id = $id;
        $this->active = $active;
    }

     public function getName(): CategoryPermissionsName
    {
        return $this->name;
    }

    public function getDescription(): CategoryPermissionsDescription
    {
        return $this->description;
    }

    public function getActive() : ?CategoryPermissionsActive {
        return $this->active;
    }

    public function getId(): ?CategoryPermissionsId
    {
        return $this->id;
    }
}