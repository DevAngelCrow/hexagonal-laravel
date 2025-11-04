<?php

namespace Src\modules\security\infrastructure\dtos\routeDtoHttpResponse;

use Src\modules\security\application\dtos\RouteDtoAggregate;
use Src\modules\security\domain\aggregate\routes\RouteWithChild;
use Src\modules\security\domain\entities\route\Route;

class RouteAggregateDtoHttp
{
    public function __construct(public readonly RouteWithChild $route) {}
    public static function fromEntity(RouteWithChild $route): self
    {
        return new self($route);
    }
    public function toArray(): array
    {
        $child = $this->route->getChildRoute();
        $parent = $this->route->getParentRoute();
        $childArray = [
            'id_parent' => $child->getIdParent()?->value(),
            'name' => $child->getName()->value(),
            'description' => $child->getDescription()->value(),
            'icon' => $child->getIcon()->value(),
            'uri' => $child->getUri()->value(),
            'active' => $child->getActive()->value(),
            'show' => $child->getShow()->value(),
            'order' => $child->getOrder()->value(),
            'permissions' => $child->getPermissions() ? array_map(function ($p) {
                return [
                    'id' => $p->getId()?->value(),
                    'name' => $p->getName()->value(),
                    'description' => $p->getDescription()->value(),
                    'id_category_permissions' => $p->getIdCategoryPermissions()->value(),
                    'active' => $p->getActive()->value()
                ];
            } , $child->getPermissions()) : null,
            'id' => $child->getId()?->value(),
            'title' => $child->getTitle()?->value()
        ];
        $parentArray = null;
        if ($parent) {
            $parentArray = [
                'id_parent' => $parent->getIdParent()?->value(),
                'name' => $parent->getName()->value(),
                'description' => $parent->getDescription()->value(),
                'icon' => $parent->getIcon()->value(),
                'uri' => $parent->getUri()->value(),
                'active' => $parent->getActive()->value(),
                'show' => $parent->getShow()->value(),
                'order' => $parent->getOrder()->value(),
                'permissions' => $child->getPermissions() ? array_map(function ($p) {
                return [
                    'id' => $p->getId()?->value(),
                    'name' => $p->getName()->value(),
                    'description' => $p->getDescription()->value(),
                    'id_category_permissions' => $p->getIdCategoryPermissions()->value(),
                    'active' => $p->getActive()->value()
                ];
            } , $child->getPermissions()) : null,
                'id' => $parent->getId()?->value(),
                'title' => $child->getTitle()?->value()
            ];
        }
        $childArray["parent_route"] = $parentArray;
        return $childArray;
    }
}
