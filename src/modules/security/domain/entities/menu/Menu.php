<?php
namespace Src\modules\security\domain\entities\menu;

use Src\modules\security\domain\value_objects\menu_value_object\MenuActive;
use Src\modules\security\domain\value_objects\menu_value_object\MenuChildren;
use Src\modules\security\domain\value_objects\menu_value_object\MenuDescription;
use Src\modules\security\domain\value_objects\menu_value_object\MenuIcon;
use Src\modules\security\domain\value_objects\menu_value_object\MenuId;
use Src\modules\security\domain\value_objects\menu_value_object\MenuName;
use Src\modules\security\domain\value_objects\menu_value_object\MenuOrder;
use Src\modules\security\domain\value_objects\menu_value_object\MenuParent;
use Src\modules\security\domain\value_objects\menu_value_object\MenuPermissions;
use Src\modules\security\domain\value_objects\menu_value_object\MenuRequiredAuth;
use Src\modules\security\domain\value_objects\menu_value_object\MenuShow;
use Src\modules\security\domain\value_objects\menu_value_object\MenuTitle;
use Src\modules\security\domain\value_objects\menu_value_object\MenuUri;

class Menu{
    private readonly MenuActive $active;
    private readonly MenuChildren $children;
    private readonly MenuPermissions $permissions;
    private readonly MenuDescription $description;
    private readonly MenuIcon $icon;
    private readonly MenuName $name;
    private readonly MenuOrder $order;
    private readonly MenuParent $parent;
    private readonly MenuRequiredAuth $required_auth;
    private readonly MenuShow $show;
    private readonly MenuTitle $title;
    private readonly MenuUri $uri;
    private readonly ?MenuId $id;

    public function __construct(
        MenuActive $active,
        MenuChildren $children,
        MenuDescription $description,
        MenuIcon $icon,
        MenuName $name,
        MenuOrder $order,
        MenuParent $parent,
        MenuRequiredAuth $required_auth,
        MenuShow $show,
        MenuTitle $title,
        MenuUri $uri,
        MenuPermissions $permissions,
        ?MenuId $id = null
    )
    {
        $this->active = $active;
        $this->children = $children;
        $this->description = $description;
        $this->icon = $icon;
        $this->name = $name;
        $this->order = $order;
        $this->parent = $parent;
        $this->required_auth = $required_auth;
        $this->show = $show;
        $this->title = $title;
        $this->uri = $uri;
        $this->permissions = $permissions;
        $this->id = $id;
    }

    public function getActive(): MenuActive
{
    return $this->active;
}

public function getChildren(): MenuChildren
{
    return $this->children;
}

public function getDescription(): MenuDescription
{
    return $this->description;
}

public function getIcon(): MenuIcon
{
    return $this->icon;
}

public function getName(): MenuName
{
    return $this->name;
}

public function getOrder(): MenuOrder
{
    return $this->order;
}

public function getParent(): MenuParent
{
    return $this->parent;
}

public function getRequiredAuth(): MenuRequiredAuth
{
    return $this->required_auth;
}

public function getShow(): MenuShow
{
    return $this->show;
}

public function getTitle(): MenuTitle
{
    return $this->title;
}

public function getUri(): MenuUri
{
    return $this->uri;
}

public function getPermissions() : MenuPermissions {
    return $this->permissions;
}

public function getId(): ?MenuId
{
    return $this->id;
}

}