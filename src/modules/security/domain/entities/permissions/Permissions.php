<?php

namespace Src\modules\security\domain\entities\permissions;

use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsDescription;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsIdCategoryPermissions;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsName;

class Permissions
{
    private readonly PermissionsName $name;
    private readonly PermissionsIdCategoryPermissions $id_category_permissions;
    private readonly PermissionsDescription $description;
    private readonly ?PermissionsId $id;

    public function __construct(PermissionsName $name, PermissionsIdCategoryPermissions $id_category_permissions, PermissionsDescription $description, ?PermissionsId $id = null)
    {
        $this->name = $name;
        $this->id_category_permissions = $id_category_permissions;
        $this->description = $description;
        $this->id = $id;
    }

    public function getName(): PermissionsName
    {
        return $this->name;
    }

    public function getIdCategoryPermissions(): PermissionsIdCategoryPermissions
    {
        return $this->id_category_permissions;
    }

    public function getDescription(): PermissionsDescription
    {
        return $this->description;
    }

    public function getId(): ?PermissionsId
    {
        return $this->id;
    }
}
