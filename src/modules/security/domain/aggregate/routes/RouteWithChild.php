<?php
namespace Src\modules\security\domain\aggregate\routes;
use Src\modules\security\domain\entities\route\Route;

class RouteWithChild {
    private Route $child_route;
    private ?Route $parent_route = null;

    public function __construct(Route $child_route, ?Route $parent_route)
    {
       
        $this->parent_route = $parent_route;
        $this->child_route = $child_route;
    }

    public function getParentRoute() : ?Route {
        return $this->parent_route;
    }

    public function getChildRoute() : Route {
        return $this->child_route;
    }
}