<?php
namespace Src\modules\security\domain\entities\route;

use Src\modules\security\domain\exceptions\RoutesException;
use Src\modules\security\domain\value_objects\permissions_value_object\PermissionsId;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesActive;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesDescription;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesIcon;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesId;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesIdParent;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesName;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesOrder;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesShow;
use Src\modules\security\domain\value_objects\routes_value_object\RoutesUri;

class Route{
    private readonly ?RoutesIdParent $id_parent;
    private readonly RoutesName $name;
    private readonly RoutesDescription $description;
    private readonly RoutesIcon $icon;
    private readonly RoutesUri $uri;
    private readonly RoutesActive $active;
    private readonly RoutesShow $show;
    private readonly RoutesOrder $order;
    /** @var PermissionsId[] */
    private readonly ?array $permissionsId;
    private readonly ?RoutesId $id;

    public function __construct(RoutesName $name, RoutesDescription $description, RoutesIcon $icon, RoutesUri $uri,
    RoutesActive $active, RoutesShow $show, RoutesOrder $order, ?RoutesIdParent $id_parent = null,  ?array $permissionsId = null, ?RoutesId $id = null
    )
    {
        $this->id_parent = $id_parent;
        $this->name = $name;
        $this->description = $description;
        $this->icon = $icon;
        $this->uri = $uri;
        $this->active = $active;
        $this->show = $show;
        $this->order = $order;
        $this->permissionsId = $permissionsId;
        $this->id = $id;

         // Validar que cada elemento del array sea una instancia de PermissionsId

        if (!empty($this->permissionsId)) {
            foreach ($this->permissionsId as $permissionId) {
                if (!$permissionId instanceof PermissionsId) {
                    throw new RoutesException("La instancia de cada elemento debe ser de tipo PermissionsId");
                }
            }
        }
    }

    public function getIdParent(): ?RoutesIdParent
    {
        return $this->id_parent;
    }

    public function getName(): RoutesName
    {
        return $this->name;
    }

    public function getDescription(): RoutesDescription
    {
        return $this->description;
    }

    public function getIcon(): RoutesIcon
    {
        return $this->icon;
    }

    public function getUri(): RoutesUri
    {
        return $this->uri;
    }

    public function getActive(): RoutesActive
    {
        return $this->active;
    }

    public function getShow(): RoutesShow
    {
        return $this->show;
    }

    public function getOrder(): RoutesOrder
    {
        return $this->order;
    }

    public function getId(): ?RoutesId
    {
        return $this->id;
    }

    public function getPermissionsId(): array
    {
        return $this->permissionsId;
    }
    
}